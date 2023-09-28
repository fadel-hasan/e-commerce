<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LogActivity
{
    // Write your helper functions here...


    public static function addToLog($subject, $id)
    {
        $log = [];
        $log['op'] = $subject;
        // $log['res'] = $res;
        $log['slug'] = Request::fullUrl();
        // $log['method'] = Request::method();
        // $log['agent'] = Request::header('user-agent');
        $log['user_id'] = $id;
        DB::table('records')->insert([
            'op'=>$log['op'],
            'slug'=>$log['slug'],
            'user_id'=>$log['user_id'],
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        // Record::create($log);
        return response('' , 200);
    }
}
