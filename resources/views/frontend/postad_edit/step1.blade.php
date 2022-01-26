@extends('frontend.postad.index')

@section('title')
    Edit Ad (Step-1) - {{ $ad->title }}
@endsection

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
            <form id="step1_edit_form" action="{{ route('frontend.post.update',$ad->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="dashboard-post__information-form">
                    <div class="input-field__group">
                        <div class="input-field">
                            <label for="adname">{{ __('website.ad_name') }}<span class="text-danger">*</span></label>
                            <input required value="{{ $ad->title }}" name="title" type="text" placeholder="{{ __('website.ad_name') }}" id="adname"  class="@error('title') border-danger @enderror"/>
                        </div>
                        <div class="input-field">
                            <label for="price">{{ __('website.price') }}<span class="text-danger">*</span></label>
                            <input required value="{{ $ad->price ?? '' }}" name="price" type="number" min="1" placeholder="Price" id="price"  class="@error('price') border-danger @enderror"/>
                        </div>
                    </div>
                    <div class="input-field__group">
                        <div class="input-select">
                            <label for="allCategory">{{ __('website.category') }}<span class="text-danger">*</span></label>
                            <select required name="category_id" id="ad_category" class="form-control select-bg @error('category_id') border-danger @enderror">
                                <option value="" hidden>{{ __('website.select_category') }}</option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $ad->category_id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-select">
                            <label for="subcategory">{{ __('website.subcategory') }}<span class="text-danger">*</span></label>
                            <select name="subcategory_id" id="ad_subcategory" class="form-control select-bg @error('subcategory_id') border-danger @enderror">
                                <option value="" selected>{{ __('website.select_subcategory') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-field__group">
                        <div class="input-select">
                            <label for="brand">{{ __('website.brand') }} <span class="text-danger">*</span></label>
                            <select required name="brand_id" id="brandd" class="form-control select-bg @error('brand_id') border-danger @enderror">
                                <option value="" hidden>{{ __('website.select_brand') }}</option>
                                    @foreach ($brands as $brand)
                                        <option {{ $brand->id == $ad->brand_id ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="modell">{{ __('website.model') }}<span class="text-danger">*</span></label>
                            <input required value="{{ $ad->model ?? '' }}" name="model" type="text" placeholder="Model" id="modell" class="@error('model') border-danger @enderror" />
                        </div>
                    </div>
                    <div class="input-field__group">
                        <div class="input-select">
                            <label for="conditionss">{{ __('website.condition') }}<span class="text-danger">*</span></label>
                            <select required name="condition" id="conditionss" class="form-control select-bg @error('condition') border-danger @enderror">
                                    <option {{ $ad->condition == 'new' ? 'selected':'' }} value="new">{{ __('website.new') }}</option>
                                    <option {{ $ad->condition == 'used' ? 'selected':'' }} value="used">{{ __('website.used') }}</option>
                            </select>
                        </div>
                        <div class="input-select">
                            <label for="authenticityy">{{ __('website.authenticity') }} <span class="text-danger">*</span></label>
                            <select required name="authenticity" id="authenticityy" class="form-control select-bg @error('authenticity') border-danger @enderror">
                                    <option {{ $ad->authenticity == 'original'? 'selected':'' }} value="original">{{ __('website.original') }}</option>
                                    <option {{ $ad->authenticity == 'refurbished'? 'selected':'' }} value="refurbished">{{ __('website.refurbished') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-check">
                                <input name="negotiable" type="hidden" value="0">
                                <input {{ $ad->negotiable == 1 ? 'checked':'' }} value="1" name="negotiable" type="checkbox" class="form-check-input" id="checkme" />
                                <label class="form-check-label" for="checkme">{{ __('website.negotiable') }} </label>
                            </div>
                        </div>

                        @if ($ad->featured)
                            <div class="col-lg-3">
                                <div class="form-check">
                                    <input name="featured" type="hidden" value="0">
                                    <input {{ $ad->featured == 1 ? 'checked':'' }} value="1" name="featured" type="checkbox" class="form-check-input" id="featured" />
                                    <label class="form-check-label" for="featured">{{ __('website.featured') }}</label>
                                </div>
                            </div>
                        @else
                            <input name="featured" type="hidden" value="0">
                        @endif
                    </div>
                </div>
                <div class="dashboard-post__action-btns">
                    <a href="{{ route('frontend.post.cancel.edit') }}" class="btn btn--lg bg-danger text-light">
                       {{ __('website.cancel_edit') }}
                        <span class="icon--right">
                            <x-svg.cross-icon />
                        </span>
                    </a>
                    <button type="button" onclick="updateCancelEdit()" class="btn btn--lg bg-warning text-light">
                        {{ __('website.update_cancel_edit') }}
                        <span class="icon--right">
                            <x-svg.cross-icon />
                        </span>
                    </button>
                    <button type="submit" class="btn btn--lg">
                        {{ __('website.update_next_step') }}
                        <span class="icon--right">
                            <x-svg.right-arrow-icon />
                        </span>
                    </button>
                </div>
                <input type="hidden" id="cancel_edit_input" name="cancel_edit" value="0">
            </form>
        </div>
    </div>
@endsection

@push('post-ad-scripts')
<script>
    // ad update and cancel edit
    function updateCancelEdit(){
        $('#cancel_edit_input').val(1)
        $('#step1_edit_form').submit()
    }
</script>
@endpush
