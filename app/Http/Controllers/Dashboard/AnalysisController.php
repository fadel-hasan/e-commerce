<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnalysisController extends Controller
{
    public function get_month_visit()
    {
        $visits = DB::table('visitors')
            ->select(DB::raw('MONTHNAME(date) as month,YEAR(date) as year,DAY(date) as day, SUM(count) as count'))
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->groupBy('month', 'year', 'day')
            ->get();

        return $visits;
    }

    public function get_month_sell()
    {
        $sells = DB::table('order_details', 'od')
            ->select(DB::raw('MONTHNAME(created_at) as month,YEAR(created_at) as year,DAY(created_at) as day, SUM(totalPrice) as money'))
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month', 'year', 'day')
            ->get();

        return $sells;
    }


    public function get_month_buy()
    {
        // order_details
        $p = DB::table('orders', 'od')
            ->join('products as p', 'od.product_id', '=', 'p.id')
            ->join('order_details', 'od.id', '=', 'order_details.order_id')
            ->select(DB::raw('MONTHNAME(od.created_at) as month,YEAR(od.created_at) as year, SUM(order_details.quantity) as count , p.name'))
            ->where('od.status', 1)
            ->whereMonth('od.created_at', Carbon::now()->month)
            ->whereYear('od.created_at', Carbon::now()->year)
            ->groupBy('month', 'year', 'p.name')
            ->get();

        return $p;
    }
    public function get_country_user()
    {
        $w = DB::table('users', 'r')
            ->select(DB::raw('r.country, count(r.id) as count'))
            ->groupBy('r.country')
            ->get();

        return $w;
    }
}
