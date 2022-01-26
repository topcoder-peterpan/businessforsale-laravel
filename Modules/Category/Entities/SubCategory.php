<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
    ];

    public static function get()
    {
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\SubCategoryFactory::new();
    }

    /**
     * Set the subcategory name.
     * Set the subcategory slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }
}
