<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Plan\Entities\Plan;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id', 'payment_type', 'customer_id', 'amount', 'plan_id',
    ];

    /**
     * Transaction customer
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     *  Customer scope
     * @return mixed
     */
    public function scopeCustomerData($query)
    {
        return $query->where('customer_id', auth('customer')->id());
    }

    /**
     * Transaction plan
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
