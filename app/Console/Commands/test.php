<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo \App\Http\Controllers\Site\VarController::getSitting('title').PHP_EOL;
        echo \App\Http\Controllers\Site\VarController::getSitting('title').PHP_EOL;
        echo \App\Http\Controllers\Site\VarController::getSitting('title').PHP_EOL;
        echo \App\Http\Controllers\Site\VarController::getSitting('title').PHP_EOL;
        echo \App\Http\Controllers\Site\VarController::getSitting('title').PHP_EOL;
    }
}
