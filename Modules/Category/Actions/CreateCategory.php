<?php

namespace Modules\Category\Actions;

use Modules\Category\Entities\Category;

class CreateCategory
{
    public static function create($request)
    {
        $category = Category::create($request->except(['image']));

        $image = $request->image;
        if ($image) {
            $url = uploadImage($image, 'category');
            $category->update(['image' => $url]);
        }

        return $category;
    }
}
