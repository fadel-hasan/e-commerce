<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            // user required
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // order required
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('order_details');
            // type method payment
            $table->string('type');
            // how much does he pay
            $table->decimal('money',10,2);
            // i use text, in future maybe payment id is long
            $table->text('id_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
