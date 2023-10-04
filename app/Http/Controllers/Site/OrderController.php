<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public static function get_orders($sort_by, $sort_order)
    {
        $sort_by = 'num' ? 'id' : 'money';
        if (!in_array($sort_by, ['id', 'money'])) {
            throw new \Exception('error Page');
        }
        $orders = DB::table('orders', 'o')
        ->where('o.user_id',auth()->user()->id)
        ->join('products as p','o.product_id','=','p.id')
        ->join('order_details as od','o.id','=','od.order_id')
            ->select('p.name','o.created_at','o.status','od.totalPrice')
            ->orderBy($sort_by, $sort_order)
            ->paginate(100);

        return $orders;
    }
}
