<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class referralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('referral_systems')->insert([
            'type' => 'normal',
            'percent' => 5
        ]);

        DB::table('referral_systems')->insert([
            'type' => 'super',
            'percent' => 15
        ]);
    }
}
