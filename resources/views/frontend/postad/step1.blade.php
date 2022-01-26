@extends('frontend.postad.index')

@section('title', __('website.step1'))

@section('post-ad-content')
    <!-- Step 01 -->
    <div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab">
        <div class="dashboard-post__information step-information">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('frontend.post.store') }}" method="POST">
                @csrf
                <div class="dashboard-post__information-form">
                    <div class="input-field__group">
                        <div class="input-field">
                            <label for="adname"> Ad Name <span class="text-danger">*</span></label>
                            <input required value="{{ $ad->title ?? '' }}" name="title" type="text" placeholder="Ad name" id="adname"  class="@error('title') border-danger @enderror"/>
                        </div>
                        <div class="input-field">
                            <label for="price"> Price <span class="text-danger">*</span></label>
                            <input required value="{{ $ad->price ?? '' }}" name="price" type="number" min="1" placeholder="Price" id="price"  class="@error('price') border-danger @enderror"/>
                        </div>
                    </div>
                    <div class="input-field__group">
                        <div class="input-select">
                            <label for="allCategory">Category <span class="text-danger">*</span></label>
                            <select required name="category_id" id="ad_category" class="form-control select-bg @error('category_id') border-danger @enderror">
                                <option value="" hidden>Select Category</option>
                                @isset($ad->category_id)
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $ad->category_id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($categories as $category)
                                        <option {{ old('category_id') == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="input-select">
                            <label for="subcategory">sub category <span class="text-danger">*</span></label>
                            <select name="subcategory_id" id="ad_subcategory" class="form-control select-bg @error('subcategory_id') border-danger @enderror">
                                <option value="" selected>Select Subcategory</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-field__group">
                        <div class="input-select">
                            <label for="brand">brand <span class="text-danger">*</span></label>
                            <select required name="brand_id" id="brandd" class="form-control select-bg @error('brand_id') border-danger @enderror">
                                <option value="" hidden>Select Brand</option>
                                @isset($ad->brand_id)
                                    @foreach ($brands as $brand)
                                        <option {{ $brand->id == $ad->brand_id ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($brands as $brand)
                                        <option {{ old('brand_id') == $brand->id ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="modell">Model <span class="text-danger">*</span></label>
                            <input required value="{{ $ad->model ?? '' }}" name="model" type="text" placeholder="Model" id="modell" class="@error('model') border-danger @enderror" />
                        </div>
                    </div>
                    <div class="input-field__group">
                        <div class="input-select">
                            <label for="conditionss">Condition <span class="text-danger">*</span></label>
                            <select required name="condition" id="conditionss" class="form-control select-bg @error('condition') border-danger @enderror">
                                @isset($ad->condition)
                                    <option {{ $ad->condition == 'new' ? 'selected':'' }} value="new">New</option>
                                    <option {{ $ad->condition == 'used' ? 'selected':'' }} value="used">Used</option>
                                @else
                                    <option value="new">New</option>
                                    <option value="used">Used</option>
                                @endisset
                            </select>
                        </div>
                        <div class="input-select">
                            <label for="authenticityy">Authenticity <span class="text-danger">*</span></label>
                            <select required name="authenticity" id="authenticityy" class="form-control select-bg @error('authenticity') border-danger @enderror">
                                @isset($ad->condition)
                                    <option {{ $ad->authenticity == 'original'? 'selected':'' }} value="original">Original</option>
                                    <option {{ $ad->authenticity == 'refurbished'? 'selected':'' }} value="refurbished">Refurbished</option>
                                @else
                                    <option value="original">Original</option>
                                    <option value="refurbished">Refurbished</option>
                                @endisset
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-check">
                                <input name="negotiable" type="hidden" value="0">
                                @isset($ad->negotiable)
                                    <input {{ $ad->negotiable == 1 ? 'checked':'' }} value="1" name="negotiable" type="checkbox" class="form-check-input" id="checkme" />
                                @else
                                    <input value="1" name="negotiable" type="checkbox" class="form-check-input" id="checkme" />
                                @endisset
                                <label class="form-check-label" for="checkme">negotiable </label>
                            </div>
                        </div>
                        @if (session('user_plan')->featured_limit)
                            <div class="col-lg-3">
                                <div class="form-check">
                                    <input name="featured" type="hidden" value="0">
                                    @isset($ad->featured)
                                        <input {{ $ad->featured == 1 ? 'checked':'' }} value="1" name="featured" type="checkbox" class="form-check-input" id="featured" />
                                    @else
                                        <input value="1" name="featured" type="checkbox" class="form-check-input" id="featured" />
                                    @endisset
                                    <label class="form-check-label" for="featured">Featured </label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="dashboard-post__action-btns">
                    <a href="{{ route('frontend.post.rules') }}" class="btn btn--lg btn--outline">
                        View Posting Rules
                    </a>
                    <button type="submit" class="btn btn--lg">
                        Next Steps
                        <span class="icon--right">
                            <x-svg.right-arrow-icon />
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
