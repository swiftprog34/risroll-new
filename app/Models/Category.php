<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_uid', 'uid');
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}
