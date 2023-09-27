<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'category_uid', 'uid');
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}