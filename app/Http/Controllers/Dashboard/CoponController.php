<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CoponController extends Controller
{
    public function get_copon()
    {
        $order = request('order', 'desc');

        if (request()->isMethod('POST')) {
            $this->store_copon();
        }

        $c = DB::table('copons')->orderBy('id',$order)->get();
        return $c;
    }


    public function store_copon()
    {
        $validator = Validator::make(request()->all(), [
            'code' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|unique:copons,code',
            'discount' => 'required',
            'count' => 'required',
            'expire_date' => 'required|date',
        ], [
            'code.required' => 'حقل الرمز مطلوب',
            'code.min' => 'يجب أن يحتوي حقل الرمز على الأقل 8 أحرف',
            'code.regex' => 'حقل الرمز يجب أن يحتوي على أحرف وأرقام معًا',
            'code.unique'=>'هذا الرمز مستخدم الرجاء الإنتباه',
            'discount.required' => 'حقل الخصم مطلوب',
            'count.required' => 'حقل العدد مطلوب',
            'expire_date.required' => 'حقل تاريخ الانتهاء مطلوب',
            'expire_date.date' => 'حقل تاريخ الانتهاء يجب أن يكون تاريخًا صحيحًا',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            session()->put('error', $error);
        } else {
            $data = [
                'code' => request('code'),
                'discount' => request('discount'),
                'count' => request('count'),
                'expire_date' => request('expire_date'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (request('id')) {
                DB::table('copons')->where('id', request('id'))->update($data);
            } else {
                DB::table('copons')->insert($data);
            }
        }
    }

    public function delete(Request $r)
    {
        $s = DB::table('copons')->delete($r->id);
        if ($s) {
            return response()->json(
                ['ok' => true],
                200
            );
        } else {
            return response()->json(
                ['ok' => false],
                422
            );
        }
    }
}
