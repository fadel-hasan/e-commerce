<?php

namespace App\Http\Controllers\PaymentGateways;

use App\Http\Controllers\Site\IndexsController;
use App\Http\Controllers\Site\ConstDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Payment extends IndexsController
{
    /**
     * Create order and view payment method
     * @param int $idProduct id order from table product
     * @param Request $request Request represents an HTTP request (from Laravel)
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createOrder(int $idProduct,Request $request) :\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory {
        $idUser = auth()->user()->id;
        $idOrder = DB::table('orders')
            ->select('id')
            ->where('user_id','=',$idUser)
            ->where('created_at','>',date('Y-n-d H:i:s',time() - (3600 * 24)))
            ->orderBy('created_at', 'desc')
            ->first();
        if (!isset($idOrder->id)) {
            DB::table('orders')->insert([
                'user_id' => $idUser,
                'created_at' => date('Y-n-d H:i:s'),
                'updated_at' => date('Y-n-d H:i:s')
            ]);
            $idOrder = DB::table('orders')
                ->where('user_id','=',$idUser)
                ->select('id')
                ->orderBy('created_at', 'desc')
                ->first();
        }
        $idOrder = $idOrder->id;
        $data = ['order_id'=>$idOrder];
        $data['payment'] = 'info';
        $data['listPayment'] = array_keys(ConstDataController::paymentMethod);
        $data['product'] = DB::table('products')
        ->where('id','=',$idProduct)
        ->first(['price','quantity'])
        ;
        return $this->view('pages.profile.payment',$data);
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
