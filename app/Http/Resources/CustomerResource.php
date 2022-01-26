<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\SubCategoryResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'image' => $this->image,
        ];
    }
}
