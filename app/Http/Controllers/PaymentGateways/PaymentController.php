<?php

namespace App\Http\Controllers\PaymentGateways;
/**
 * use payment method here
*/
use App\Http\Controllers\PaymentGateways\{PayeerController};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Site\IndexsController;
use App\Http\Controllers\Site\ConstDataController;

class PaymentController extends IndexsController
{
    /**
     * Create order and view payment method
     * @param int $idProduct id order from table product
     * @param Request $request Request represents an HTTP request (from Laravel)
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|never
     */
    public function createOrder(int $idProduct, Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $idUser = auth()->user()->id;
        $more = $this->getIdDevs(array_keys($request->except('_token')));
        $idOrder = DB::table('orders')
            ->select('id')
            ->where('user_id', '=', $idUser)
            ->where('product_id', '=', $idProduct)
            ->where('dev', '=', $more)
            ->where('created_at', '>', date('Y-n-d H:i:s', time() - 3600))
            ->orderBy('created_at', 'desc')
            ->first();
        if (!isset($idOrder->id) and $request->method() == 'POST') {
            $idOrder = DB::table('orders')->insertGetId([
                'user_id'       => $idUser,
                'product_id'    => $idProduct,
                'dev'           => $more,
                'created_at'    => date('Y-n-d H:i:s'),
                'updated_at'    => date('Y-n-d H:i:s')
            ]);
            $hash = Str::random(1024);
            DB::table('user_use_copon')
                ->insert([
                    'user_id'   => $idUser,
                    'date'      => date('Y-n-d H:i:s'),
                    'hash'      => $hash
                ]);
        } else {
            $hash = DB::table('user_use_copon')
                ->where('date', '>', date('Y-n-d H:i:s', time() - 3600))
                ->where('user_id', '=', $idUser)
                ->first('hash')
                ->hash;
            $idOrder = $idOrder->id;
        }
        return redirect(route('user.payment.order', ['paymentOrder' => $idOrder]));
    }
    /**
     * view order if he will pay this order
     * @param int $idProduct id order from table product
     * @param Request $request Request represents an HTTP request (from Laravel)
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|never
     */
    public function viewOrder(int $idOrder, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $idUser = auth()->user()->id;
        $data = ['order_id' => $idOrder];
        $data['product'] = DB::table('orders', 'o')
            ->where('o.id', '=', $idOrder)
            ->where('o.user_id','=',$idUser)
            ->where('o.created_at','>',date('Y-n-d H:i:s',time() - 3600))
            ->where('o.status','=','2')
            ->join('products as p', 'p.id', '=', 'o.product_id')
            ->first(['p.price as price', 'p.quantity as quantity','o.dev as dev','p.information as information']);
        if (!isset($data['product']->price)) {
            return abort(403);
        }
        $data['price'] = $data['product']->price + $this->priceMore($data['product']->dev);
        $hash = DB::table('user_use_copon')
            ->where('date', '>', date('Y-n-d H:i:s', time() - 3600))
            ->where('user_id', '=', $idUser)
            ->first('hash')
            ->hash;
        $data['payment'] = 'info';
        $data['listPayment'] = array_keys(ConstDataController::paymentMethod);
        $data['hash'] = $hash;
        return $this->view('pages.profile.payment', $data);
    }
    /**
     * pay order
     * @param int $idProduct id order from table product
     * @param Request $request Request represents an HTTP request (from Laravel)
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|never
     */
    public function payOrder(int $idOrder, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $copone_id = 0;
        if (!empty($request->get('copone'))) {
            $copone = DB::table('copons')
            ->where('code','=',$request->get('copone'))
            ->where('updated_at','>',date('Y-n-d H:i:s',time() - 3600));
            $copone_id = $copone->first()->id ?? 0;
        }
        $price = 0;
        $priceGet = DB::table('orders','o')
        ->where('o.id','=',$idOrder)
        ->where('o.status','=','2')
        ->where('o.created_at','>',date('Y-n-d H:i:s',time() - 3600))
        ->join('products as p','p.id','=','o.product_id')
        ->select('p.price as price','o.dev as devs','o.user_id as user_id')
        ->first()
        ;
        // for check from order for it is done hi don't pay agen
        if (!isset($priceGet->price)) {
            abort(403);
        }
        $price = $priceGet->price;
        foreach (explode('#',$priceGet->devs) as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $price += DB::table('product_devs')
            ->where('id','=',$value)
            ->first()
            ->price;
        }
        if ($copone_id != 0) {
            $price -= $price * $copone->first()->discount / 100;
        }
        $price *= $request->get('quantity');
        if ($request->get('method') == 'USDT') {
            $noUse = [];
            while (true) {
                $price += rand(0,15) / 10000;
                if (in_array($price,$noUse)) {
                    $order_details = DB::table('orders','o')
                    ->join('order_details as s',function ($join)
                    {
                        $join->on('s.order_id','=','o.id');
                    })
                    ->where('s.totalPrice','=',$price)
                    ->where('o.status','=','2');
                    if ($order_details->count() == 0) {
                        break;
                    }
                } else if (count($noUse) >= 50) {
                    $price += rand(15,20) / 100000;
                }
                $noUse[] = $price;
            }
        }
        $order_details = DB::table('order_details')
        ->where('order_id','=',$idOrder);
        if ($order_details->count() == 0) {
            DB::table('order_details')
            ->insert([
                'order_id' => $idOrder,
                'quantity' => $request->get('quantity'),
                'totalPrice' => $price,
                'copone_id' => $copone_id,
                'details' => $request->get('details'),
                'created_at' => date('Y-n-d H:i:s'),
                'updated_at' => date('Y-n-d H:i:s'),
            ]);
        } else {
            $order_details
            ->update([
                'quantity' => $request->get('quantity'),
                'totalPrice' => $price,
                'copone_id' => $copone_id,
                'details' => $request->get('details'),
                'updated_at' => date('Y-n-d H:i:s'),
            ]);
        }
        $data = [];
        $data['payment'] = $request->get('method');
        $data['order_id'] = $idOrder;
        $data['price'] = $price;
        $this->setSession($idOrder,$priceGet->user_id,($copone_id != 0));
        return $this->view('pages.profile.payment', $data);
    }
    /**
     * after pay for check from order
     *
     * @param string $method name payment method
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     **/
    public function afterPay(string $method) :\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        // start controller
        $nameClass = "App\\Http\\Controllers\\PaymentGateways\\". ucfirst($method) . "Controller";
        $class = new $nameClass();
        $order = DB::table('orders', 'o')
        ->where('o.id', '=', session('idOrder'))
        ->where('o.user_id','=',session('user_id'))
        ->where('o.created_at','>',date('Y-n-d H:i:s',time() - 3600))
        ->where('o.status','=','2')
        ->join('products as p', 'p.id', '=', 'o.product_id');
        if ($class->run()) {
            $order->update(['o.status'=>1]);
            $this->removeSession();
            return redirect(route('user.product',[
                    'uri'=>$order->first(['p.cool_name as cool_name'])->cool_name
                ])
            )->with('success','تم الدفع بنجاح');
        }
        return redirect(route('user.product',[
                'uri'=>$order->first(['p.cool_name as cool_name'])->cool_name
            ])
        )->with('fail','فشل الدفع');
    }
    /**
     * exec some thing after accept pay
     * @param int|float $profit how much money profit site
     * @return void
     */
    public static function success(int|float $profit) :void
    {
        DB::table('profits')
            ->insert([
                'date' => date('Y-n-d'),
                'profit' => $profit
            ]);
    }
    /**
     * privte functions
     */
    /**
     * set session for check these information after pay
     * @param int $idOrder id order
     * @param int $user_id id user
     * @return void
     */
    private function setSession(int $idOrder,int $user_id,bool $is_copons) :void
    {
        session()->put('idOrder',$idOrder);
        session()->put('user_id',$user_id);
        session()->put('is_copons',$is_copons);
    }
    /**
     * remove session after pay
     * @return void
     */
    private function removeSession() :void
    {
        session()->remove('idOrder');
        session()->remove('user_id');
        session()->remove('is_copons');
    }
    /**
     * get price all dev
     * @param string $devs after convert with `getIdDevs`
     * @return int
     */
    private function priceMore(?string $devs = '') :int
    {
        $select = DB::table('product_devs')
        ->whereIn('id',explode('#',$devs),'or')
        ->get();
        $price = 0;
        foreach ($select as $key => $value) {
            $price += $value->price;
        }
        return $price;
    }
    /**
     * get devs as string
     * @param ?array $devs
     * @return string
     */
    private function getIdDevs(?array $devs = []): string
    {
        if (empty($devs)) {
            return '';
        }
        // Convert array to text
        $implode = implode('#', $devs);
        // remove name more from string
        $result = str_replace('more#', '', $implode);
        return $result;
    }
}
