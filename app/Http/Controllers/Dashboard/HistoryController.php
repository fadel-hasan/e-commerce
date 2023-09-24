<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function get_records()
    {
        $order = request('order', 'desc');
        if (request('q')) {
            $r = DB::table('users', 'u')
                ->rightJoin('records as r', 'u.id', '=', 'r.user_id')
                ->where('u.name', 'LIKE', '%' . request('q') . '%')
                ->orWhere('u.email', 'LIKE', '%' . request('q') . '%')
                ->orWhere('u.country', 'LIKE', '%' . request('q') . '%')
                ->orderBy('r.created_at', $order)
                ->select('u.name', 'u.email', 'u.ip', 'u.country', 'r.op', 'r.slug', 'r.created_at')
                ->paginate(50);
        } else {
            $r = DB::table('users', 'u')
                ->rightJoin('records as r', 'u.id', '=', 'r.user_id')
                ->orderBy('r.created_at', $order)
                ->select('u.name', 'u.email', 'u.ip', 'u.country', 'r.op', 'r.slug', 'r.created_at')
                ->paginate(50);
        }

        return $r;
    }
}
