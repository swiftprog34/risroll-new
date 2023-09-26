<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function pickupPoints() {
        return $this->hasMany(Pickup::class);
    }

    public function promotions() {
        return $this->hasMany(Promotion::class);
    }

    public function deliveryZones() {
        return $this->hasMany(DeliveryZone::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }
}
