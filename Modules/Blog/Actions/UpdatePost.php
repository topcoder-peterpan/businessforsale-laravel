<?php

namespace Modules\Blog\Actions;

class UpdatePost
{
    public static function update($request, $post)
    {
        $post->update($request->except(['image', 'tags']));

        $image = $request->image;
        if ($image) {
            deleteImage($post->image);
            $url = uploadImage($image, 'post');
            $post->update(['image' => $url]);
        }

        $post->tags()->sync($request->tags);

        return $post;
    }
}
