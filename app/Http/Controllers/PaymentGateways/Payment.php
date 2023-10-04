<?php

namespace App\Http\Controllers\PaymentGateways;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Site\IndexsController;
use App\Http\Controllers\Site\ConstDataController;

class Payment extends IndexsController
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
            DB::table('orders')->insert([
                'user_id'       => $idUser,
                'product_id'    => $idProduct,
                'dev'           => $more,
                'created_at'    => date('Y-n-d H:i:s'),
                'updated_at'    => date('Y-n-d H:i:s')
            ]);
            $idOrder = DB::table('orders')
                ->where('user_id', '=', $idUser)
                ->select('id')
                ->orderBy('created_at', 'desc')
                ->first();
            $hash = Str::random(1024);
            DB::table('user_use_copon')
                ->insert([
                    'user_id'   => $idUser,
                    'date'      => date('Y-n-d H:i:s'),
                    'hash'      => $hash
                ]);
        } else {
            $hash = DB::table('user_use_copon')
                ->where('date', '>', date('Y-n-d H:i:s', time() - (3600 * 24)))
                ->where('user_id', '=', $idUser)
                ->first('hash')
                ->hash;
        }
        return redirect(route('user.payment.order', ['paymentOrder' => $idOrder->id]));
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
            ->where('status','=','2')
            ->join('products as p', 'p.id', '=', 'o.product_id')
            ->first(['p.price as price', 'p.quantity as quantity','o.dev as dev']);
        if (!isset($data['product']->price)) {
            return abort(403);
        }
        $data['price'] = $data['product']->price + $this->priceMore($data['product']->dev);
        $hash = DB::table('user_use_copon')
            ->where('date', '>', date('Y-n-d H:i:s', time() - (3600 * 24)))
            ->where('user_id', '=', $idUser)
            ->first('hash')
            ->hash;
        $data['payment'] = 'info';
        $data['listPayment'] = array_keys(ConstDataController::paymentMethod);
        $data['hash'] = $hash;
        return $this->view('pages.profile.payment', $data);
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
}







/* DB::table('order_details')->insert([
            'order_id' => $idOrder,
            'product_id' => $idProduct,
            'quantity' => 0,
            'totalPrice' => 0,
            'created_at' => date('Y-n-d H:i:s'),
            'updated_at' => date('Y-n-d H:i:s')
        ]); */
