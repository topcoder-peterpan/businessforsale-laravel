<?php

namespace Modules\Category\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Response;
use Modules\Category\Actions\UpdateCategory;
use Modules\Category\Actions\SortingCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Category\Entities\SubCategory;
use Modules\Category\Http\Requests\CategoryFormRequest;
use Modules\Category\Repositories\CategoryRepositories;

class CategoryController extends Controller
{
    use ValidatesRequests;

    protected $category;

    public function __construct(CategoryRepositories $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the categories.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userCan('category.view')) {
            return abort(403);
        }
        $categories = Category::oldest('order')->paginate(10);
        return view('category::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('category.create')) {
            return abort(403);
        }
        return view('category::category.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        if (!userCan('category.create')) {
            return abort(403);
        }

        try {
            $this->category->store($request);

            flashSuccess('Category Added Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (!userCan('category.update')) {
            return abort(403);
        }
        return view('category::category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryFormRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        if (!userCan('category.update')) {
            return abort(403);
        }
        try {
            UpdateCategory::update($request, $category);
            flashSuccess('Category Updated Successfully');
            return redirect(route('module.category.index'));
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!userCan('category.delete')) {
            return abort(403);
        }

        try {
            $this->category->destroy($category);
            flashSuccess('Category Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        if (!userCan('category.update')) {
            return abort(403);
        }
        try {
            SortingCategory::sort($request);
            return response()->json(['message' => 'Category Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Get subcateogry by category id
     * @param int $category_id
     * @return \Illuminate\Http\Response
     */
    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->latest()->get()->map(fn ($item) => [
            'id' => $item->id,
            'name' => $item->name,
        ]);
        return response()->json($subcategories);
    }
}
