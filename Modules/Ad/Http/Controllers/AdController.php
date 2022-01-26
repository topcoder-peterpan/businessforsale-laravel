<?php

namespace Modules\Ad\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Actions\CreateAd;
use Modules\Brand\Entities\Brand;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Ad\Entities\AdFeature;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Modules\Ad\Http\Requests\AdFormRequest;

class AdController extends Controller
{
    /**
     * Display a listing of the ads.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userCan('ad.view')) {
            return abort(403);
        }

        $query = Ad::query();
        $data = [];

        if (request()->has('keyword') && request()->keyword != null) {
            $query->where('title', "LIKE", "%" . request('keyword') . "%");
        }

        if (request()->has('category') && request()->category != null) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
            $data['category'] = Category::where('slug', request('category'))->first();
        }

        if (request()->has('city') && request()->city != null) {
            $query->whereHas('city', function ($q) {
                $q->where('name', request('city'));
            });
            $data['city'] = City::where('name', request('city'))->first();
        }

        if (request()->has('customer') && request()->customer != null) {
            $query->whereHas('customer', function ($q) {
                $q->where('username', request('customer'));
            });
            $data['customer'] = Customer::where('username', request('customer'))->first();
        }

        $data['ads'] = $query->with(['category:id,name,slug', 'city:id,name'])->latest('id')->paginate(10)->withQueryString();

        return view('ad::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('ad.create')) {
            return abort(403);
        }

        $data['cities'] = City::get();
        $data['brands'] = Brand::get();
        $data['customers'] = Customer::get();

        return view('ad::create', $data);
    }

    public function getSubcategory($id)
    {
        echo json_encode(SubCategory::where('category_id', $id)->get());
    }

    public function getTown($id)
    {
        echo json_encode(Town::where('city_id', $id)->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AdFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdFormRequest $request)
    {
        if (!userCan('ad.create')) {
            return abort(403);
        }

        $ad = new Ad();
        $ad->title = $request->title;
        $ad->slug = Str::slug($request->title);
        $ad->customer_id = $request->customer_id;
        $ad->category_id = $request->category_id;
        $ad->subcategory_id = $request->subcategory_id;
        $ad->brand_id = $request->brand_id;
        $ad->city_id = $request->city_id;
        $ad->town_id = $request->town_id;
        $ad->model = $request->model;
        $ad->condition = $request->condition;
        $ad->authenticity = $request->authenticity;
        $ad->negotiable = $request->negotiable ? $request->negotiable : 0;
        $ad->price = $request->price;
        $ad->description = $request->description;
        $ad->phone = $request->phone;
        $ad->phone_2 = $request->phone_2;
        $ad->featured = $request->featured ? $request->featured : 0;
        $ad->save();

        // image uploading
        $image = $request->thumbnail;
        if ($image) {
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs("public/images", $image, $fileName);
            $url = 'storage/images/' . $fileName;
            $ad->thumbnail = $url;
            $ad->update();
        }

        // feature inserting
        foreach ($request->features as $feature) {
            if ($feature) {
                $ad->adFeatures()->create(['name' => $feature]);
            }
        }

        flashSuccess('Ad Created Successfully');
        return redirect()->route('module.ad.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        if (!userCan('ad.view')) {
            return abort(403);
        }

        $ad->load('adFeatures', 'galleries', 'city', 'town', 'category', 'subcategory', 'customer', 'galleries', 'brand');
        return view('ad::show', compact('ad'));
    }


    public function edit(Ad $ad)
    {
        $data['brands'] = Brand::get();
        $data['customers'] = Customer::get();

        $data['cities'] = City::get();
        $data['towns'] = Town::where('city_id', $ad->city->id)->get();

        $data['categories'] = Category::get();
        $data['subcategories'] = SubCategory::where('category_id', $ad->category->id)->get();

        return view('ad::edit', compact('ad'), $data);
    }

    public function update(AdFormRequest $request, Ad $ad)
    {
        if (!userCan('ad.update')) {
            return abort(403);
        }

        $ad->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'customer_id' => $request->customer_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'city_id' => $request->city_id,
            'town_id' => $request->town_id,
            'model' => $request->model,
            'condition' => $request->condition,
            'authenticity' => $request->authenticity,
            'negotiable' => $request->negotiable ? $request->negotiable : 0,
            'price' => $request->price,
            'description' => $request->description,
            'phone' => $request->phone,
            'phone_2' => $request->phone_2,
            'featured' => $request->featured ? $request->featured : 0,
        ]);

        // image updating
        $image = $request->thumbnail;
        if ($image) {

            if (file_exists(public_path($ad->thumbnail))) {
                @unlink(public_path($ad->thumbnail));
            }

            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs("public/images", $image, $fileName);
            $url = 'storage/images/' . $fileName;

            $ad->thumbnail = $url;
            $ad->update();
        }

        // feature inserting
        $ad->adFeatures()->delete();
        foreach ($request->features as $feature) {
            if ($feature) {
                $ad->adFeatures()->create(['name' => $feature]);
            }
        }

        flashSuccess('Ad Updated Successfully');
        return redirect()->route('module.ad.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        if (!userCan('ad.delete')) {
            return abort(403);
        }

        try {

            if (file_exists(public_path($ad->thumbnail))) {
                @unlink(public_path($ad->thumbnail));
            }

            $ad->delete();

            flashSuccess('Ad Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }
}
