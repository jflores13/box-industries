<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_en',
        'short_es',
        'long_en',
        'long_es',
        'slug',
        'button_en',
        'button_es',
        'home_en',
        'home_es',
        'button_link',
        'image_src',
        'booklet_src',
        'product_id',
        'category',
        'tags',
        'on_carrousel',
    ];

    protected $casts = [
        'on_carrousel' => 'boolean',
    ];
}
