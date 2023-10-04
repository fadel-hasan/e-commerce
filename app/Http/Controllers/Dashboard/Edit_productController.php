<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Edit_productController extends Controller
{
    public static function date()
    {


        $p = DB::table('products')->where('id', request('idProduct'))
        ->first('*');
        if ($p) {

        $dev = DB::table('product_devs')->where('product_id', $p->id)->select('id', 'name', 'price')
            ->get()->map(function ($item) {
                return (object) [
                    'id'     => $item->id,
                    'name'   => $item->name,
                    'price'  => $item->price,
                ];
            });
        $res = [
            'product' => $p,
            'dev' => $dev
        ];
        session()->flashInput($res);
    }
    }
}
