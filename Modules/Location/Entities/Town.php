<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Town extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Location\Database\factories\TownFactory::new();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
