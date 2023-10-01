<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthController;
use Stevebauman\Location\Facades\Location;

class DashboardController extends Controller
{

    private $d;
    public function __construct()
    {
        $this->d = new VarController();
    }

    public  function  getIndex($view, $date = [])
    {
        return view($view, array_merge(['navbarLinks' => $this->d->navbarLink()], $date));
    }

    public function index()
    {
        return $this->getIndex('pages.dashboard.home', ['boxs' => $this->d->boxs(), 'users' => $this->d->users(), 'orders' => $this->d->orders()]);
    }

    public function indexMember($type = 'num', $order = 'asc')
    {

        $date[0] = $this->d->member($type, $order);
        $date[1] = $order;
        $date[2] = $type;
        $name[0] = 'members';
        $name[1] = 'sort_order';
        $name[2] = 'sort_by';
        return $this->getIndex('pages.dashboard.member', array_combine($name, $date));
    }



    public function indexAnalysis()
    {
        $date = [
            0 => $this->d->month_visit(),
            1 => $this->d->month_sell(),
            2 => $this->d->month_buy(),
            3 => $this->d->user_country()
        ];
        $name = [
            0 => 'visits',
            1 => 'sells',
            2 => 'buys',
            3 => 'countries'
        ];
        return $this->getIndex('pages.dashboard.analysis', array_combine($name, $date));
    }

    public function indexHistory()
    {
        $date = [$this->d->records()];
        $name = ['records'];
        return $this->getIndex('pages.dashboard.history', array_combine($name, $date));
    }

    public function indexAdmin()
    {
        $date = [$this->d->admins()];
        $name = ['admins'];
        return $this->getIndex('pages.dashboard.add-admin', array_combine($name, $date));
    }

    public function indexSitting()
    {
        $date = [$this->d->sittings()];
        $name = ['commands'];
        return $this->getIndex('pages.dashboard.sitting', array_combine($name, $date));
    }

    public function indexSection()
    {
        $date = [$this->d->sections()];
        $name = ['sections'];
        return $this->getIndex('pages.dashboard.add-category', array_combine($name, $date));
    }

    public function indexProduct()
    {
        $date = $this->d->products();
        $name = ['products','sections'];
        return $this->getIndex('pages.dashboard.add-product', array_combine($name, $date));
    }












    // public function get_month_visit()
    // {
    //     $visits = DB::table('visitors')
    //         ->select(DB::raw('MONTH(date) as month,YEAR(date) as year, SUM(count) as count'))
    //         ->groupBy(DB::raw('MONTH(date),YEAR(date)'))
    //         ->get('count');
    //     return response()->json($visits);
    // }






    // public function add_seller($userId)
    // {
    //     $newRole = DB::table('roles')->where('name', 'seller')->value('id');
    //     DB::table('users')
    //         ->where('id', $userId)
    //         ->update(['role_id' => $newRole]);
    // }


    public function get_location(Request $r)
    {
        // $ip = $r->ip();
        //or
        // $ip = $_SERVER['REMOTE_ADDR'];


        // $location = Location::get($ip);
        // if ($r->ipinfo->ip == '127.0.0.1') {
        //     $r->ipinfo->ip = '211.197.11.0';

        //     dd($r->ipinfo);
        // } else {
        // }
        /////////////////////////
        // $ip = $r->ip();
        // $token = env("IPINFO_SECRET");
        // $url = "ipinfo.io/$ip?token=$token";
        // $response = Http::get($url);

        // $jsonData = $response->json();

        // dd($jsonData);

        $ip = '149.34.244.177';
        $data = Location::get($ip);
        dd($data);
    }

    //     public function get_month_sell()
    //     {
    //         $sells = DB::table('order_details')->selectRaw('Day(created_at) as day,Month(created_at) as month,SUM(totalPrice) as sum')
    //             // ->whereMonth('created_at', Carbon::now()->month)
    //             ->groupBy('day', 'month')
    //             ->get();
    //         return response()->json($sells);
    //     }

    //     public function get_count_product_month()
    //     {
    //         $sells = DB::table('order_details', 'o')->selectRaw('products.name,sum(o.quantity) as count')
    //             ->whereMonth('o.created_at', Carbon::now()->month)
    //             ->join('products', 'o.product_id', '=', 'products.id')
    //             ->groupBy('products.name')->get();
    //         return response()->json($sells);
    //     }
    // }
}
