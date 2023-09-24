<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryZone extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function goodsReceivings() {
        return $this->hasMany(GoodsReceiving::class);
    }

    public function indices() {
        return $this->hasMany(Index::class);
    }
}
