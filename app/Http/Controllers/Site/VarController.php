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
        return /* DB::table('products','p')
        ->select('p.id as id','p.name as title','p.price as price','p.url_image as image','p.description as des','sections.name as category','p.barcode as link')
        ->join('sections','p.section_id','=','sections.section_id')
        ->limit(10)
        ->orderBy('id','asc')
        ->get() */;
    }
}
