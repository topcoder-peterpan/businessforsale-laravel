<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\Blog\Entities\Post;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }

    /**
     * Set the category name.
     * Set the category slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Ad[]
     */
    function ads(): HasMany
    {
        return $this->hasMany(Ad::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
