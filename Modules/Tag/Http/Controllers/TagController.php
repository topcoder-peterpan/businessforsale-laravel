<?php

namespace Modules\Tag\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Tag\Entities\Tag;
use Illuminate\Routing\Controller;
use Modules\Tag\Actions\CreateTag;
use Modules\Tag\Actions\DeleteTag;
use Modules\Tag\Actions\UpdateTag;
use Modules\Tag\Actions\MultipleDeleteTag;
use Illuminate\Contracts\Support\Renderable;
use Modules\Tag\Http\Requests\TagFormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TagController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('tag.view')) {
            return abort(403);
        }
        $tags = Tag::latest()->get();
        return view('tag::index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('tag.create')) {
            return abort(403);
        }
        return view('tag::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TagFormRequest $request)
    {
        if (!userCan('tag.create')) {
            return abort(403);
        }
        $tag = CreateTag::create($request);

        if ($tag) {
            flashSuccess('Tag Added Successfully');
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
    public function edit(Tag $tag)
    {
        if (!userCan('tag.update')) {
            return abort(403);
        }
        return view('tag::edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TagFormRequest $request, Tag $tag)
    {
        if (!userCan('tag.update')) {
            return abort(403);
        }
        $tag = UpdateTag::update($request, $tag);

        if ($tag) {
            flashSuccess('Tag Updated Successfully');
            return redirect(route('module.tag.index'));
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
    public function destroy(Tag $tag)
    {
        if (!userCan('tag.delete')) {
            return abort(403);
        }

        $tag = DeleteTag::delete($tag);

        if ($tag) {
            flashSuccess('Tag Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    public function multipleDestroy(Request $request)
    {
        if (!userCan('tag.delete')) {
            return abort(403);
        }

        $tag = MultipleDeleteTag::delete($request);

        if ($tag) {
            return response()->json(['message' => 'Selected Tag Items Deleted Successfully!']);
        } else {
            flashError();
            return back();
        }
    }
}
