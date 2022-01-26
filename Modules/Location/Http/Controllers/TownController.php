<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('town.view')) {
            return abort(403);
        }
        $towns = Town::with('city:id,name')->paginate(10);
        return view('location::town.index', compact('towns'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('town.create')) {
            return abort(403);
        }
        $cities = City::all();
        return view('location::town.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (!userCan('town.create')) {
            return abort(403);
        }
        $request->validate([
            'city_id' => 'required',
            'name' => 'required|string|max:30|min:3|alpha_spaces|unique:towns,name'
        ]);

        $town = Town::create([
            'city_id' => $request->city_id,
            'name' => $request->name
        ]);

        $town ? flashSuccess('Town created successfully') : flashError();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Town $town)
    {
        if (!userCan('town.update')) {
            return abort(403);
        }
        $cities = City::get();
        return view('location::town.edit', compact('town', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Town $town)
    {
        if (!userCan('town.update')) {
            return abort(403);
        }
        $request->validate([
            'city_id' => 'required',
            'name' => "required|string|max:30|min:3|alpha_spaces|unique:towns,name,{$town->id}"
        ]);

        $town->city_id = $request->city_id;
        $town->name = $request->name;
        $update = $town->update();

        $update ? flashSuccess('Town updated successfully') : flashError();
        return redirect()->route('module.town.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Town $town)
    {
        if (!userCan('town.delete')) {
            return abort(403);
        }

        $delete = $town->delete();
        $delete ? flashSuccess('Town deleted successfully') : flashError();
        return back();
    }
}
