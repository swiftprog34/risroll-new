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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id');
            $table->string('username', 255);
            $table->string('phone', 255);
            $table->text('comment')->nullable();
            $table->integer('persons')->default(0);
            $table->text('street')->nullable();
            $table->string('home')->nullable();
            $table->string('apart')->nullable();
            $table->string('entrance')->nullable();
            $table->string('floor')->nullable();
            $table->text('receiving_type')->nullable();
            $table->string('to_date')->nullable();
            $table->string('to_time')->nullable();
            $table->text('pay_type')->nullable();
            $table->string('date_time')->nullable();
            $table->integer('total_sum_without_delivery')->nullable();
            $table->integer('total_sum')->nullable();
            $table->integer('delivery_price')->nullable();
            $table->text('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
