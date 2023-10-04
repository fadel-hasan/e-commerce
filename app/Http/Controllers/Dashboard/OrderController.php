<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function get_order()
    {
        $order = request('order', 'desc');
        $o=DB::table('orders','o')
        ->join('users as u','o.user_id','=','u.id')
        ->join('products as p','o.product_id','=','p.id')
        ->select('u.name as u_name','u.email','p.name as p_name','o.status','o.created_at')
        ->orderBy('o.id',$order)
        ->paginate(50);

        return $o;
    }
}
