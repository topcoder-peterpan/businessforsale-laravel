<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plan\Database\factories\PriceplanFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'label', 'price', 'ad_limit', 'featured_limit', 'customer_support', 'multiple_image', 'badge', 'recommended'
    ];

    protected $casts = [
        'customer_support'  =>  'boolean',
        'multiple_image'    =>  'boolean',
        'badge'             =>  'boolean',
    ];


    protected static function newFactory()
    {
        return PriceplanFactory::new();
    }
}
