<?php

namespace Modules\Category\Actions;

class UpdateCategory
{
    public static function update($request, $category)
    {
        $category->update($request->except('image'));

        $image = $request->image;
        if ($image) {
            $url = uploadImage($image, 'category');
            $category->update(['image' => $url]);
        }

        return $category;
    }
}
