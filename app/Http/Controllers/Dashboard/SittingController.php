<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SittingController extends Controller
{
    public function get_command()
    {
        // if ( request()->method() == 'POST') {
        //     $keys = request()->keys();
        //     $updates = [];
        //     foreach ($keys as $key) {
        //         $value = request()->input($key);
        //         $c = DB::table('sittings')->where('command', $key)->first();
        //         if ($c && $c->value !== $value) {
        //             $updates[$key] = $value;
        //         }
        //     }
        //     if (!empty($updates)) {
        //         foreach ($updates as $key => $value) {
        //             DB::table('sittings')->where('command', $key)->update(['value' => $value]);
        //         }
        //     }
        // }

        //this way best for better query from previous
        if (request()->method() == 'POST') {
            $updates = [];
            $all = request()->all();
            $keys = array_slice(array_keys($all), 1);
            // dd($keys);
            $values = array_slice(array_values($all),1);
            $dbValues = DB::table('sittings')->whereIn('command', $keys)->pluck('value', 'command')->toArray();
            foreach ($keys as $index => $key) {
                if (isset($dbValues[$key]) && $dbValues[$key] !== $values[$index]) {
                    $updates[] = ['command' => $key, 'value' => $values[$index]];
                }
            }
            if (!empty($updates)) {
                foreach ($updates as $update) {
                    DB::table('sittings')->where('command', $update['command'])->update(['value' => $update['value']]);
                }
            }
        }
            $c = DB::table('sittings')->select('command', 'value')->get();
            return $c;
    }
}
