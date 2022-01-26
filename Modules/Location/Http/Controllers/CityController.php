<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('city.view')) {
            return abort(403);
        }
        $cities = City::latest()->paginate(10);
        return view('location::city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('city.create')) {
            return abort(403);
        }
        return view('location::city.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (!userCan('city.create')) {
            return abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:30|min:3|alpha_spaces|unique:cities,name',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = uploadImage($request->image, 'city');
        }

        $city = City::create([
            'name' => $request->name,
            'image' => $fileName,
        ]);

        $city ? flashSuccess('City created successfully') : flashError();
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('location::city.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(City $city)
    {
        if (!userCan('city.update')) {
            return abort(403);
        }
        return view('location::city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, City $city)
    {
        if (!userCan('city.update')) {
            return abort(403);
        }
        $request->validate([
            'name' => "required|string|max:30|min:3|alpha_spaces|unique:cities,name,{$city->id}",
        ]);

        // delete old file from storage
        if ($request->hasFile('image')) {
            deleteImage($city->image);
        }

        // set new file name
        $fileName = $request->old_image;
        if ($request->hasFile('image')) {
            $fileName = uploadImage($request->image, 'city');
        }

        // update city
        $city->name = $request->name;
        $city->image = $fileName;
        $update = $city->update();

        // result after update
        $update ? flashSuccess('City updated successfully') : flashError();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(City $city)
    {
        if (!userCan('city.delete')) {
            return abort(403);
        }

        // file remove
        if ($city->image) {
            deleteImage($city->image);
        }

        // delete city
        $delete = $city->delete();

        // result after delete
        $delete ? flashSuccess('City deleted successfully') : flashError();
        return back();
    }

    public function getTowns($city_id)
    {
        return Town::where('city_id', $city_id)->get();
    }
}
