<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Actions\DeleteSubCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Category\Actions\CreateSubCategory;
use Modules\Category\Http\Requests\SubCategoryFormRequest;
use Modules\Category\Actions\UpdateSubCategory;

class SubCategoryController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('subcategory.view')) {
            abort(403);
        }
        $sub_categories = SubCategory::latest()->get();
        return view('category::subcategory.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('subcategory.create')) {
            abort(403);
        }
        $categories = Category::all();
        return view('category::subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SubCategoryFormRequest $request
     * @return Renderable
     */
    public function store(SubCategoryFormRequest $request)
    {
        if (!userCan('subcategory.create')) {
            abort(403);
        }
        $subcategory = CreateSubCategory::create($request);

        if ($subcategory) {
            flashSuccess('SubCategory Added Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(SubCategory $subcategory)
    {
        if (!userCan('subcategory.update')) {
            abort(403);
        }
        $categories = Category::all();
        return view('category::subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param SubCategoryFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(SubCategoryFormRequest $request, SubCategory $subcategory)
    {
        if (!userCan('subcategory.update')) {
            abort(403);
        }
        $subcategory = UpdateSubCategory::update($request, $subcategory);

        if ($subcategory) {
            flashSuccess('SubCategory Updated Successfully');
            return redirect(route('module.subcategory.index'));
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(SubCategory $subcategory)
    {
        if (!userCan('subcategory.delete')) {
            abort(403);
        }

        $subcategory = DeleteSubCategory::delete($subcategory);

        if ($subcategory) {
            flashSuccess('SubCategory Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}
