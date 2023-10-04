<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function get_num_daily_visit()
    {
        $count = DB::table('visitors')->where('date', date('Y-m-d'))->value('count');
        return ($count ?? 0);
    }

    public function get_num_month_visit()
    {
        $visits = DB::table('visitors')
            ->selectRaw('SUM(count) as total_visits')
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->first();
        return ($visits->total_visits ?? 0);
    }

    public function get_num_user()
    {
        $total_user = DB::table('users')->selectRaw('count(id) as num')->first();
        return ($total_user->num  ?? 0);
    }


    public function get_num_product()
    {
        $total_product = DB::table('products')->selectRaw('sum(quantity) as num')->first();
        return ($total_product->num ?? 0);
    }

    public function get_latest_users()
    {
        $latest_users = DB::table('users')
            ->select('users.name', 'users.email', 'roles.name as role')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.created_at', 'desc')
            ->take(10)
            ->get();
        return $latest_users;
    }

    public function get_latest_orders()
    {
        $latest_order = DB::table('orders', 'o')
            ->join('users as u', 'o.user_id', '=', 'u.id')
            // ->join('order_details as od', 'o.id', '=', 'od.order_id')
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select('o.status', 'p.name as p_name', 'p.price', 'u.name as u_name')
            ->orderBy('o.created_at', 'desc')
            ->take(10)
            ->get();

        return $latest_order;
    }


    public function get_num_seller()
    {
        $role = DB::table('roles')->where('name', 'seller')->value('id');
        $numSellers = DB::table('users')
            ->select(DB::raw('count(users.id) as num'))
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.role_id', $role)
            ->first();

        return ($numSellers->num ?? 0);
    }

    public function get_count_sell_day()
    {
        $sells = DB::table('order_details')->selectRaw('SUM(quantity) as sum')
            ->whereDay('created_at', Carbon::now()->day)
            ->first();
        return ($sells->sum ?? 0);
    }

    public function get_count_sell_all()
    {
        $sells = DB::table('order_details')->selectRaw('SUM(quantity) as sum')
            ->first();
        return ($sells->sum ?? 0);
    }
    // public function get_members($page)
    // {
    //     $limit = 100;
    //     $offset = ($page - 1) * $limit;

    //     $members = DB::table('users')
    //         ->select('users.name', 'users.email', 'roles.name as role')
    //         ->join('roles', 'users.role_id', '=', 'roles.id')
    //         ->offset($offset)
    //         ->limit($limit)
    //         ->get();

    //     return $members;
    // }
    public function get_oldest_users()
    {
        $oldest_users = DB::table('users')
            ->select('users.name', 'users.email', 'roles.name as role')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.created_at', 'asc')
            ->take(10)
            ->get();
        return $oldest_users;
    }


    public function get_price_sell_day()
    {
        $sells = DB::table('order_details')->selectRaw('SUM(totalPrice) as sum')
            ->whereDay('created_at', Carbon::now()->day)->first();
        return $sells->sum;
    }
}
