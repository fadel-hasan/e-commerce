<?php

namespace App\Http\Controllers\PaymentGateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CoponController extends Controller
{
    /**
     * check is copon is true
     * @param string $hash hash for chech database
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(string $hash) :\Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $count = DB::table('user_use_copon')
        ->where('hash','=',$hash)
        ->where('date','>',date('Y-n-d H:i:s',time() - 3600))
        ->first('count')
        ->count;
        if ($count < 6) {
            DB::table('user_use_copon')
                ->where('hash','=',$hash)
                ->where('date','>',date('Y-n-d H:i:s',time() - 3600))
                ->update(['count'=>DB::raw('`user_use_copon`.`count` + 1')]);
            $copon = DB::table('copons')
            ->where('code','=',request('code'))
            ->where('status','=','1')
            ->where('expire_date','>',date('Y-n-d'))
            ->where('count','>','0');
            if ($copon->count() > 0) {
                $discount = $copon->first('discount')->discount;
                if ($copon->first('count')->count == 1) {
                    $copon->update(['updated_at'=>date('Y-n-d H:i:s'),'count'=>DB::raw('`copons`.`count` - 1'),'status'=>'0']);
                } else {
                    $copon->update(['updated_at'=>date('Y-n-d H:i:s'),'count'=>DB::raw('`copons`.`count` - 1')]);
                }
                return response([
                    'ok'        => true,
                    'discount'  =>$discount
                ]);
            }
        }
        return response([
            'ok' => false
        ]);
    }
}
