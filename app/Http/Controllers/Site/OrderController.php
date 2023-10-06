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
            ->where('o.user_id', auth()->user()->id)
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->join('order_details as od', 'o.id', '=', 'od.order_id')
            ->select('p.name', 'o.created_at', 'o.status', 'od.totalPrice')
            ->orderBy($sort_by, $sort_order)
            ->paginate(100);

        return $orders;
    }

    public function get_order(Request $r)
    {
        $order = DB::table('orders', 'o')
            ->join('users as u', 'o.user_id', '=', 'u.id')
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->join('order_details as od', 'o.id', '=', 'od.order_id')
            ->where('o.id', $r->id)
            ->select('u.name as user_name', 'u.email', 'o.status', 'p.name as p_name', 'od.quantity', 'o.dev', 'od.totalPrice')
            ->first();


        if ($order)
        {
            // get order information order without dev if not found
            if (empty($order->dev))
            {
                return response([
                    'ok'=>true,
                    'result'=>$order,
                ]);
            }
            else
            {
                //get dev product if found
                $dev_numbers = explode('#', $order->dev);
                $dev_array = array_map('intval', $dev_numbers);
                $dev = DB::table('product_devs')->whereIN('id',$dev_array)
                ->select('name','price')
                ->get();
                return response([
                    'ok'=>true,
                    'result'=>$order,
                    'dev'=>$dev
                ]);
            }
        }
        else {
            return response(['ok' => false], 404);
        }
    }
}
