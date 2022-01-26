<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPlan extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_id', 'ad_limit', 'featured_limit', 'customer_support', 'multiple_image', 'badge'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $casts = [
        'customer_support'  =>  'boolean',
        'multiple_image'  =>  'boolean',
        'badge'  =>  'boolean',
    ];

    /**
     *  Customer scope
     * @return mixed
     */
    public function scopeCustomerData($query)
    {
        return $query->where('customer_id', auth('customer')->id());
    }

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
