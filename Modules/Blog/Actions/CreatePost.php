<?php

namespace Modules\Blog\Actions;

use Modules\Blog\Entities\Post;

class CreatePost
{
    public static function create($request)
    {
        $post = Post::create($request->except(['image', 'tags']));

        $image = $request->image;
        if ($image) {
            $url = uploadImage($image, 'post');
            $post->update(['image' => $url]);
        }

        $post->tags()->attach($request->tags);
        return $post;
    }
}
