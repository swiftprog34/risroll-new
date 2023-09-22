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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug', 128);
            $table->string('city_name', 255);
            $table->string('email', 128);
            $table->string('phone');
            $table->string('vk_link', 255)->nullable();
            $table->string('instagram_link', 256)->nullable();
            $table->string('w_id');
            $table->string('restaurant_id');
            $table->text('contact_map')->nullable();
            $table->text('contact_page_info')->nullable();
            $table->text('delivery_map')->nullable();
            $table->text('delivery_page_info')->nullable();
            $table->text('promotions_page_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
