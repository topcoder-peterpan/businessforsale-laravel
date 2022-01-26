<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\Blog\Entities\Post;
use Modules\Tag\Database\factories\TagFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected static function newFactory()
    {
        return TagFactory::new();
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

    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'ad_tags', 'ad_id', 'tag_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}
