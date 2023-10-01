<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SittingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $command = ['title','des','tags','file','facebook','twitter','telegram','website','instagram','privacy-policy','terms-of-use','refund-of-funds','why-we'];
        $value = ['العنوان','وصف','tag1,tag2,tag3','','','','','','','','','',''];
        for ($i=0; $i <count($command) ; $i++) {
            DB::table('sittings')->insert([
                'command'=>$command[$i],
                'value'=>$value[$i],
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);

        }
    }
}
