<?php

namespace App\Http\Controllers\PaymentGateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayeerController extends Controller
{
    private $payeer;
    /**
     * Create connection with API Payeer
     */
    public function __construct()
    {
        $this->payeer = new CPayeerController(env('account_private'),env('id_private'),env('key_private'));
    }
    /**
     * check is request from payeer after go to pay
     * @return bool
     */
    public function issetGet() :bool
    {
        if (request('successPayeer') or request('failPayeer') or request('status')) {
            return true;
        }
        return false;
    }
    /**
     * check is request from payeer
     * @return bool
     */
    public function issetGetForPay()
    {
        if ($this->issetGet() and request('m_desc') and !empty(request('m_desc'))) {
            return true;
        }
        return false;
    }
    /**
     * how much does member pay
     * @return int
     */
    public function AmounyPay()
    {
        if ($this->issetGet()) {
            // Get order details
            $arShopHistory = $this->payeer->getShopOrderInfo([
                'shopId' => env('id_shop'),
                'orderId' => request('m_orderid'),
            ]);
            // select in databases
            $info_order = DB::table('payment')
            ->where('id_payment','=',request('m_orderid'))
            ->where('type','=','payeer');
            if ($info_order->count() == 0) {
                // insert information in database, because cancel any repeat in data
                DB::table('payment')->insert([
                    'id_payment' => request('m_orderid'),
                    'type'       => 'payeer',
                    'user_id'    => session('user_id'),
                    'order_id'   => session('order_id'),
                    'money'      => $arShopHistory['info']['sumOut'],
                    'is_copons'  => session('is_copons') ? true : false,
                ]);
                return $arShopHistory['info']['sumOut'];
            }
        }
        return 0;
    }
}
