<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VarController extends Controller
{
    /**
     * Storage data in variable for less querys
     * @var array<array<string>> $sitting
     */
    private static array $sitting = [];
    /**
     * Storage data in variable $sitting for less querys
     * @return void
     */
    private static function configSitting(): void
    {
        $select = DB::table('sittings')
            ->select('*')
            ->get();
        foreach ($select as $sitting) {
            self::$sitting[$sitting->command] = $sitting->value;
        }
    }
    /**
     * Get Sitting from cach storage for less querys
     * @param string $command name command that get value is
     * @return string
     */
    public static function getSitting(string $command): string
    {
        if (count(self::$sitting) == 0) {
            self::configSitting();
        }
        return self::$sitting[$command] ?? "error";
    }
    /**
     * Get products from databases limte 10
     * @return \Illuminate\Support\Collection
     */
    public static function getProducts()
    {
        return $p = DB::table('products', 'p')->join('sections as s', 's.id', '=', 'p.section_id')
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
    }

    public static function get_user()
    {
        return DB::table('users')->selectRaw('count(id) as num')->first();
    }

    public static function get_product()
    {
        return DB::table('products')->selectRaw('count(id) as num')->first();
    }

    public static function sells()
    {
        return DB::table('order_details')->selectRaw('sum(totalPrice) as price')->first();
    }

    public static function product()
    {
        $p = new ProductController();
        $array = $p->product();
        $product = $array['product'];
        $more = $array['dev'];
        $res = [
            'name'          => $product->name,
            'url'           => $product->cool_name,
            'image'         => $product->url_image,
            'desProduct'    => $product->description,
            'price'         => $product->price,
            'id'            => $product->id,
            'more'          => $more
        ];
        return $res;
    }

    public static function section()
    {
        $p = new ProductController();
        $res = $p->section();
        return $res;
    }
}
