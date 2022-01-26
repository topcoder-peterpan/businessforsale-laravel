<?php

namespace Modules\Location\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Ad\Entities\Ad;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Location\Database\factories\CityFactory::new();
    }

    /**
     *  Has many relation with Ad
     *
     */
    function ads()
    {
        return $this->hasMany(Ad::class, 'city_id');
    }
}
