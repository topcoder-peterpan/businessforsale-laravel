<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Ad\Entities\Ad;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($customer) {
            $setting = Setting::first();
            $customer->userPlan()->create([
                'ad_limit'  =>  $setting->free_ad_limit,
                'featured_limit'  =>  $setting->free_featured_ad_limit,
                'multiple_image' => true
            ]);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $guard = 'customer';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     *  HasMany
     * @return HasMany|Collection|Customer
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }


    /**
     * User Pricing Plan
     *
     * @return HasOne
     *
     */
    public function userPlan(): HasOne
    {
        return $this->hasOne(UserPlan::class);
    }




    /**
     * User Transactions
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
