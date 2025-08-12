<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'long_description',
        'slug',
        'button_text',
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
