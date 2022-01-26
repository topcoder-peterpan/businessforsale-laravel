<?php

namespace Modules\Ad\Entities;

use App\Models\Customer;
use Modules\Tag\Entities\Tag;
use Modules\Brand\Entities\Brand;
use Modules\Ad\Entities\AdFeature;
use Modules\Location\Entities\City;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use Modules\Ad\Database\factories\AdFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\SubCategory;
use Modules\Location\Entities\Town;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return AdFactory::new();
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
     *  Has many
     * @return BelongsTo|Collection|City[]
     */
    function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }


    /**
     *  BelongTo
     * @return BelongsTo|Collection|Category[]
     */
    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Category[]
     */
    function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Customer[]
     */
    function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     *  Has Many
     * @return HasMany|Collection|AdGallery[]
     */
    function galleries(): HasMany
    {
        return $this->hasMany(AdGallery::class);
    }


    /**
     *  BelongTo
     * @return BelongsTo|Collection|Customer[]
     */
    function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'ad_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ad_tags', 'tag_id', 'ad_id');
    }

    public function adFeatures()
    {
        return $this->hasMany(AdFeature::class, 'ad_id');
    }

    /**
     * Ad town
     *
     * @return BelongsTo
     */
    public function town(): BelongsTo
    {
        return $this->belongsTo(Town::class, 'town_id');
    }
}
