<?php

namespace Modules\Tag\Actions;

use Modules\Tag\Entities\Tag;

class MultipleDeleteTag
{
    public static function delete($request)
    {
        return Tag::whereIn('id', $request->id)->delete();
    }
}
