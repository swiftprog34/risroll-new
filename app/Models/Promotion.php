<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}
