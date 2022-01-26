<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'paypal',
        'paypal_live_mode',
        'stripe',
        'razorpay',
        'paystack',
        'ssl_commerz',
    ];

    public $timestamps = false;
}
