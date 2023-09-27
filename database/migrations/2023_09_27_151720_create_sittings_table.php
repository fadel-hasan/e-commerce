<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sittings', function (Blueprint $table) {
            $table->id();
            $table->string('command');
            $table->longText('value')->nullable();
            $table->timestamps();
        });
        Artisan::call('db:seed --class=SittingSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sittings');
    }
};
