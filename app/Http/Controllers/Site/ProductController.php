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
            ->paginate(10)
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
}
