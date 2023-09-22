<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function get_members($sort_by, $sort_order)
    {
        $sort_by = 'num' ? 'u.id' : 'money';
        if (!in_array($sort_by, ['u.id', 'money'])) {
            throw new \Exception('error Page');
        }
        $members = DB::table('users', 'u')
            ->leftJoin('orders as o', 'o.user_id', '=', 'u.id')
            ->leftJoin('order_details as od', function ($join) {
                $join->on('o.id', '=', 'od.order_id')->where('od.status', 1);
            })
            ->select('u.name', 'u.email', DB::raw('sum(od.totalPrice) as money'), 'u.country')
            ->groupBy('u.name', 'u.email', 'u.country')
            ->orderBy($sort_by, $sort_order)
            ->paginate(100);

        return $members;
    }
}
