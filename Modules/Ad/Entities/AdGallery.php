<?php

namespace Modules\Ad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdGallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Ad\Database\factories\AdGalleryFactory::new();
    }


    /**
     *  Belongs To
     * @return BelongsTo|Collection|Feature[]
     */
    function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }
}
