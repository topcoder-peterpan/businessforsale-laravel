<?php

namespace Modules\Tag\Actions;

class UpdateTag
{
    public static function update($request, $tag)
    {
        return $tag->update($request->all());
    }
}
