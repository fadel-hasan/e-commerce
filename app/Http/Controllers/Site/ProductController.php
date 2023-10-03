<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function get_product()
    {
        $p = DB::table('products', 'p')->join('sections as s', 's.id', '=', 'p.section_id')
            ->select('p.name as p_name', 'p.cool_name as p_url', 'p.url_image', 's.name as s_name', 's.url as s_url', 'p.description')
            ->paginate(10, '*', 'page', request('page'))
            ->map(function ($item) {
                return [
                    'image'         => $item->url_image,
                    'title'         => $item->p_name,
                    "des"           => $item->description,
                    "category"      => $item->s_name,
                    'link'          => $item->p_url,
                    'linkCategory'  => $item->s_url,
                ];
            });
        // sleep(2);
        return response([
            'ok' => true,
            'result' => $p
        ]);
    }

    public function get_product_section()
    {
        $p = DB::table('products', 'p')->join('sections as s', 's.id', '=', 'p.section_id')
            ->where('s.name', request('uri'))
            ->select('p.name as p_name', 'p.cool_name as p_url', 'p.url_image', 's.name as s_name', 's.url as s_url', 'p.description')
            ->paginate(10, '*', 'page', request('page'))
            ->map(function ($item) {
                return [
                    'image'         => $item->url_image,
                    'title'         => $item->p_name,
                    "des"           => $item->description,
                    "category"      => $item->s_name,
                    'link'          => $item->p_url,
                    'linkCategory'  => $item->s_url,
                ];
            });
        // sleep(2);
        return response([
            'ok' => true,
            'result' => $p
        ]);
    }


    public function product()
    {

        $p = DB::table('products')->where('cool_name', request('uri'))
            ->first('*');
        if ($p) {

            $dev = DB::table('product_devs')->where('product_id', $p->id)->select('id', 'name', 'price')
                ->get()->map(function ($item) {
                    return [
                        'id'     => $item->id,
                        'name'   => $item->name,
                        'price'  => $item->price,
                    ];
                });
            $res = [
                'product' => $p,
                'dev' => $dev
            ];
            return $res;
        }

        abort(404);
    }

    public function section()
    {
        $s = DB::table('sections')->where('url', request('uri'))->first('*');
        if ($s) {
            $p = DB::table('products')->where('section_id', $s->id)->paginate(10);
            $res = ['section' => $s, 'product' => $p];
            return $res;
        }
        abort(404);
    }

    
}
