<?php

namespace Modules\Tag\Actions;

use Modules\Tag\Entities\Tag;

class CreateTag
{
    public static function create($request)
    {
        return Tag::create($request->all());
    }
}
