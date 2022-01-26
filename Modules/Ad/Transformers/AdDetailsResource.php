<?php

namespace Modules\Ad\Transformers;

use App\Http\Resources\CustomerResource;
use Modules\Brand\Transformers\BrandResource;
use Modules\Ad\Transformers\AdFeaturesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResource;
use Modules\Location\Transformers\CityResource;
use Modules\Location\Transformers\TownResource;

class AdDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'thumbnail' => $this->thumbnail,
            'phone' => $this->phone,
            'email' => $this->email,
            'website_link' => $this->website_link,
            'address' => $this->address,
            'featured' => $this->featured,
            'total_views' => $this->total_views,
            'map_address' => $this->map_address,
            'condition' => $this->condition,
            'authenticity' => $this->authenticity,
            'model' => $this->model,
            'created_at' => $this->created_at,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'ad_features' => AdFeaturesResource::collection($this->whenLoaded('adFeatures')),
            'galleries' => AdGalleriesResource::collection($this->whenLoaded('galleries')),
            'city'  => new CityResource($this->whenLoaded('city')),
            'town'  => new TownResource($this->whenLoaded('town')),
        ];
    }
}
