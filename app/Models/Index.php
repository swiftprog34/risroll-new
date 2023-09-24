<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function deliveryZone() {
        return $this->belongsTo(DeliveryZone::class, 'delivery_zone_id');
    }
}
