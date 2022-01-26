<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Faq\Actions\SortingFaqCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Faq\Entities\FaqCategory;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('faqcategory.view')) {
            return abort(403);
        }
        if (!enableModule('faq')) {
            abort(404);
        }
        $data['faqCategories'] = FaqCategory::oldest('order')->get();
        return view('faq::faqcategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('faqcategory.create')) {
            return abort(403);
        }
        if (!enableModule('faq')) {
            abort(404);
        }
        return view('faq::faqcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (!userCan('faqcategory.create')) {
            return abort(403);
        }
        if (!enableModule('faq')) {
            abort(404);
        }
        $request->validate([
            'name' => 'required|alpha_spaces|unique:faq_categories,name',
            'icon' => 'required',
        ]);

        FaqCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon
        ]);

        flashSuccess('Faq Category Successfully Created');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(FaqCategory $faq_category)
    {
        if (!userCan('faqcategory.update')) {
            return abort(403);
        }
        return view('faq::faqcategory.edit', compact('faq_category'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, FaqCategory $faq_category)
    {
        if (!userCan('faqcategory.update')) {
            return abort(403);
        }
        $request->validate([
            'name' => "required|alpha_spaces|unique:faq_categories,name,{$faq_category->id}"
        ]);

        $faq_category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon
        ]);

        flashSuccess('Faq Category Successfully Updated');
        return redirect()->route('module.faq.category.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param FaqCategory $faq_category
     * @return Renderable
     */
    public function destroy(FaqCategory $faq_category)
    {
        if (!userCan('faqcategory.delete')) {
            return abort(403);
        }

        $faq_category->delete();

        flashSuccess('Faq Category Successfully Deleted');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param $request
     * @return Response
     */
    public function updateOrder(Request $request)
    {
        if (!userCan('faqcategory.update')) {
            return abort(403);
        }
        try {
            SortingFaqCategory::sort($request);
            return response()->json(['message' => 'Faq Category Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }
}
