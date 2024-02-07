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

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getPhoneNumberAttribute()
    {
        $cleaned = preg_replace('/[^[:digit:]]/', '', $this->phone);
        preg_match('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', $cleaned, $matches);
        return "{$matches[1]}({$matches[2]}){$matches[3]}-{$matches[4]}-{$matches[5]}";
    }
}
