<?php

namespace App\Models;

use App\Enums\GoodsReceivingVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceiving extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'receiving_variant' => GoodsReceivingVariant::class
    ];

    public function zone() {
        return $this->belongsTo(DeliveryZone::class, 'delivery_zone_id');
    }
}
