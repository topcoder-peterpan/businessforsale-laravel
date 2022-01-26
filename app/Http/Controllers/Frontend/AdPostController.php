<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use App\Http\Controllers\Controller;
use App\Http\Traits\AdCreateTrait;
use Modules\Category\Entities\Category;
use Modules\Location\Entities\City;

class AdPostController extends Controller
{
    use AdCreateTrait;

    /**
     * Ad Create step 1.
     * @return void
     */
    public function postStep1()
    {
        $this->stepCheck();
        if (session('step1')) {
            $categories = Category::latest('id')->get();
            $brands = Brand::latest('id')->get();
            $ad = session('ad');

            return view('frontend.postad.step1', compact('categories', 'brands', 'ad'));
        } else {
            return redirect()->route('frontend.post');
        }
    }

    /**
     * Ad Create step 2.
     *
     * @return void
     */
    public function postStep2()
    {
        if (session('step2')) {
            $ad = session('ad');
            $citis = City::latest('id')->get();

            return view('frontend.postad.step2', compact('ad', 'citis'));
        } else {
            return redirect()->route('frontend.post');
        }
    }

    /**
     * Ad Create step 3.
     *
     * @return void
     */
    public function postStep3()
    {
        if (session('step3')) {
            return view('frontend.postad.step3');
        } else {
            return redirect()->route('frontend.post');
        }
    }

    /**
     * Store Ad Create step 1.ul Islam <devboyarif@gmail.com>
     *  @param  Request $request
     * @return void
     */
    public function storePostStep1(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:ads,title',
            'price' => 'required|numeric',
            'model' => 'required',
            'condition' => 'required',
            'authenticity' => 'required',
            'negotiable' => 'required',
            'featured' => 'sometimes',
            'category_id' => 'required',
            'subcategory_id' => 'sometimes',
            'brand_id' => 'required',
        ]);

        if (empty(session('ad'))) {
            $ad = new Ad();
            $ad['slug'] = Str::slug($request->title);
            $ad->fill($validatedData);
            $request->session()->put('ad', $ad);
        } else {
            $ad = session('ad');
            $ad['slug'] = Str::slug($request->title);
            $ad->fill($validatedData);
            $request->session()->put('ad', $ad);
        }

        $this->step1Success();
        return redirect()->route('frontend.post.step2');
    }

    /**
     * Store Ad Create step 2.
     *  @param  Request $request
     * @return void
     */
    public function storePostStep2(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required',
            'phone_2' => 'sometimes',
            'city_id' => 'required',
            'town_id' => 'required',
        ]);

        $ad = session('ad');
        $ad->fill($validatedData);
        $request->session()->put('ad', $ad);

        $this->step1Success2();
        return redirect()->route('frontend.post.step3');
    }

    /**
     * Store Ad Create step 3.
     *  @param  Request $request
     * @return void
     */
    public function storePostStep3(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'images' => 'required',
        ]);

        $ad = session('ad');
        $ad['description'] = $validatedData['description'];
        $ad['customer_id'] = auth('customer')->id();
        $request->session()->put('ad', $ad);
        $ad->save();

        // image uploading
        $images = $request->file('images');
        foreach ($images as $key => $image) {
            if ($key == 0) {
                $url = uploadImage($image, 'images');
                $ad->update(['thumbnail' => $url]);
            }

            $url = uploadImage($image, 'ad_multiple');
            $ad->galleries()->create(['image' => $url]);
        }

        // feature inserting
        $features = $request->features;
        foreach ($features as $feature) {
            $ad->adFeatures()->create(['name' => $feature]);
        }

        $this->forgetStepSession();
        $this->adNotification($ad);
        $this->userPlanInfoUpdate($ad->featured);

        return view('frontend.postad.postsuccess', [
            'ad_slug' => $ad->slug,
            'mode' => 'create'
        ]);
    }

    /**
     * Ad Edit step 1.
     * @return void
     */
    public function editPostStep1(Ad $ad)
    {
        if (auth('customer')->id() == $ad->customer_id) {
            $this->stepCheck();
            session(['edit_mode' => true]);

            if (session('step1') && session('edit_mode')) {
                $ad = collectionToResource($this->setAdEditStep1Data($ad));
                $categories = Category::latest('id')->get();
                $brands = Brand::latest('id')->get();

                return view('frontend.postad_edit.step1', compact('ad', 'categories', 'brands'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }

    /**
     * Ad Edit step 2.
     *
     * @return void
     */
    public function editPostStep2(Ad $ad)
    {
        if (auth('customer')->id() == $ad->customer_id) {
            $ad = collectionToResource($this->setAdEditStep2Data($ad));

            if (session('step2') && session('edit_mode')) {
                $citis = City::latest('id')->get();

                return view('frontend.postad_edit.step2', compact('ad', 'citis'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }


    /**
     * Edit Ad step 3.
     *
     * @return void
     */
    public function editPostStep3(Ad $ad)
    {
        $ad->load('adFeatures', 'galleries');

        if (auth('customer')->id() == $ad->customer_id) {
            $ad = collectionToResource($this->setAdEditStep3Data($ad));

            if (session('step3') && session('edit_mode')) {
                return view('frontend.postad_edit.step3', compact('ad'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }

    /**
     * Update Ad step 1.ul Islam <devboyarif@gmail.com>
     *  @param  Request $request
     * @return void
     */
    public function UpdatePostStep1(Request $request, Ad $ad)
    {
        $request->validate([
            'title' => "required|unique:ads,title,$ad->id",
            'price' => 'required|numeric',
            'model' => 'required',
            'condition' => 'required',
            'authenticity' => 'required',
            'negotiable' => 'sometimes',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        $ad->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'model' => $request->model,
            'condition' => $request->condition,
            'authenticity' => $request->authenticity,
            'negotiable' => $request->negotiable,
            'featured' => $request->featured,
        ]);


        if ($request->cancel_edit) {
            $this->forgetStepSession();
            return redirect()->route('frontend.dashboard');
        } else {
            $this->step1Success();
            return redirect()->route('frontend.post.edit.step2', $ad->slug);
        }
    }

    /**
     * Update Ad step 2.
     *  @param  Request $request
     * @return void
     */
    public function updatePostStep2(Request $request, Ad $ad)
    {
        $request->validate([
            'phone' => 'required',
            'phone_2' => 'sometimes',
            'city_id' => 'required',
            'town_id' => 'required',
        ]);

        $ad->update([
            'phone' => $request->phone,
            'phone_2' => $request->phone_2,
            'city_id' => $request->city_id,
            'town_id' => $request->town_id,
        ]);

        if ($request->cancel_edit) {
            $this->forgetStepSession();
            return redirect()->route('frontend.dashboard');
        } else {
            $this->step1Success2();
            return redirect()->route('frontend.post.edit.step3', $ad->slug);
        }
    }

    /**
     * Update Ad step 3.
     *  @param  Request $request
     * @return void
     */
    public function updatePostStep3(Request $request, Ad $ad)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $ad->update(['description' => $request->description]);

        // feature inserting
        $ad->adFeatures()->delete();
        foreach ($request->features as $feature) {
            if ($feature) {
                $ad->adFeatures()->create(['name' => $feature]);
            }
        }

        // image uploading
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                $url = uploadImage($image, 'ad_multiple');
                $ad->galleries()->create(['image' => $url]);
            }
        }

        $this->forgetStepSession();
        $this->adNotification($ad, 'update');

        return view('frontend.postad.postsuccess', [
            'ad_slug' => $ad->slug,
            'mode' => 'update',
        ]);
    }

    /**
     * Cancel Ad Edit.
     * @return void
     */
    public function cancelAdPostEdit()
    {
        $this->forgetStepSession();
        return redirect()->route('frontend.dashboard');
    }
}
