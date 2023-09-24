<?php

use App\Models\DeliveryZone;
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
        Schema::create('goods_receivings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('receiving_variant');
            $table->integer('price')->default(0);
            $table->foreignIdFor(DeliveryZone::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_receivings');
    }
};
