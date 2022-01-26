<?php

namespace Modules\Faq\Http\Controllers;


use Modules\Faq\Entities\Faq;
use Illuminate\Routing\Controller;
use Modules\Faq\Actions\DeleteFaq;
use Modules\Faq\Actions\UpdateFaq;
use Illuminate\Contracts\Support\Renderable;
use Modules\Faq\Http\Requests\FaqFormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Faq\Actions\CreateFaq;
use Modules\Faq\Entities\FaqCategory;

class FaqController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($slug = null)
    {
        if (!userCan('faq.view')) {
            return abort(403);
        }

        if (!enableModule('faq')) {
            abort(404);
        }

        $faq_category = FaqCategory::select('id', 'name', 'slug')->get();

        if ($slug) {
            $faqs = $faqs = Faq::whereHas('faq_category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
                ->get();
        } else {
            if ($faq_category->count() > 0) {
                $faqs = Faq::where('faq_category_id', $faq_category->first()->id)->get();
            }
        }

        return view('faq::index', [
            'faqs' => $faqs,
            'faq_category' => $faq_category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('faq.create')) {
            return abort(403);
        }

        if (!enableModule('faq')) {
            abort(404);
        }
        $faq_categories = FaqCategory::oldest('order')->get();
        return view('faq::create', compact('faq_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param FaqFormRequest $request
     * @return Renderable
     */
    public function store(FaqFormRequest $request)
    {
        if (!userCan('faq.create')) {
            return abort(403);
        }
        $request->validate([
            'faq_category_id' => "required",
            'question' => "required",
            'answer' => "required"
        ]);

        $faq = CreateFaq::create($request);

        if ($faq) {
            flashSuccess('Faq Created Successfully');
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
    public function edit(Faq $faq)
    {
        if (!userCan('faq.update')) {
            return abort(403);
        }
        if (!enableModule('faq')) {
            abort(404);
        }
        $faq_categories = FaqCategory::oldest('order')->get();
        return view('faq::edit', compact('faq', 'faq_categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param FaqFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(FaqFormRequest $request, Faq $faq)
    {
        if (!userCan('faq.update')) {
            return abort(403);
        }
        $faq = UpdateFaq::update($request, $faq);

        if ($faq) {
            flashSuccess('Faq Updated Successfully');
            return redirect(route('module.faq.index'));
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
    public function destroy(Faq $faq)
    {
        if (!userCan('faq.delete')) {
            return abort(403);
        }

        $faq = DeleteFaq::delete($faq);

        if ($faq) {
            flashSuccess('Faq Deleted Successfully');
            return redirect(route('module.faq.index'));
        } else {
            flashError();
            return back();
        }
    }
}
