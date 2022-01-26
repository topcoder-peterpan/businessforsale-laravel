<?php

namespace Modules\Tag\Actions;

class DeleteTag
{
    public static function delete($tag)
    {
        return $tag->delete();
    }
}
