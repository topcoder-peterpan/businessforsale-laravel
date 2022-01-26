<?php

namespace Modules\Ad\Actions;

use App\Actions\File\FileUpload;
use Modules\Ad\Entities\AdGallery;

class CreateAdGallery
{
    public static function create($request, $id)
    {
        foreach ($request->file as $image) {
            if ($image) {
                $url = FileUpload::upload($image, 'ad_multiple/');
                AdGallery::create([
                    'ad_id' => $id,
                    'image' => $url,
                ]);
            }
        }

        return true;
    }
}
