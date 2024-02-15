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
        Schema::table('cities', function (Blueprint $table) {
            $table->time('time_from')->default('12:00:00');
            $table->time('time_till')->default('21:00:00');
            $table->integer('utc_time')->default(3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('time_from');
            $table->dropColumn('time_till');
            $table->dropColumn('utc_time');
        });
    }
};
