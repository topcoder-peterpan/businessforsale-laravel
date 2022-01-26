<?php

namespace App\Actions\Frontend;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;

class ProfileUpdate
{
    public static function update($request, $customer)
    {
        $customer->update($request->except('image'));

        $image = $request->image;
        if ($image) {
            $customerImage = file_exists($customer->image);

            if ($customerImage && $customer->image != 'backend/image/default.png') {
                FileDelete::delete($customer->image);
            }

            $url = FileUpload::upload($image, 'customer');
            $customer->update(['image' => $url]);
        }

        return $customer;
    }
}
