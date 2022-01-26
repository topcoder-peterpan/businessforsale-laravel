@extends('layouts.frontend.layout_one')

@section('title', __('website.ad_post'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_post_ads_background_path">
        {{ __('website.overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}" class="breedcrumb__page-link text--body-3">{{ __('website.dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.post_ads') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="dashboard-post">
                        <ul class="nav dashboard-post__nav mb-3">
                            {{-- Step 1  --}}
                            @if (request()->route()->getName() === "frontend.post")
                                <a href="{{ route('frontend.post') }}">
                                    <x-ad.ad-step/>
                                </a>
                            @else
                                <button disabled>
                                    <x-ad.ad-step/>
                                </button>
                            @endif

                            {{-- Step 2 --}}
                            @if (request()->route()->getName() === "frontend.post.step2")
                                <a href="{{ route('frontend.post.step2') }}">
                                    <x-ad.ad-step2/>
                                </a>
                            @else
                                <button disabled>
                                    <x-ad.ad-step2/>
                                </button>
                            @endif

                            {{-- Step 3 --}}
                            @if (request()->route()->getName() === "frontend.post.step3")
                                <a href="{{ route('frontend.post.step3') }}">
                                    <x-ad.ad-step3/>
                                </a>
                            @else
                                <button disabled>
                                    <x-ad.ad-step3/>
                                </button>
                            @endif
                        </ul>
                        <div class="tab-content dashboard-post__content" id="pills-tabContent">
                            @yield('post-ad-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($ad->category_id)
            <input type="hidden" id="cat_id" value="{{ $ad->category_id }}">
        @else
            <input type="hidden" id="cat_id" value="">
        @endisset

        @isset($ad->city_id)
            <input type="hidden" id="ct_id" value="{{ $ad->city_id }}">
        @else
            <input type="hidden" id="ct_id" value="">
        @endisset
    </section>
    <!-- dashboard section end  -->
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script>
        // session category wise subcategory
        var cat_id = document.getElementById('cat_id').value;
        var ct_id = document.getElementById('ct_id').value;
        if (cat_id){ cat_wise_subcat(cat_id) }
        if (ct_id){ city_wise_town(ct_id) }

        // Category wise subcategories
        $('#ad_category').on('change', function() {
        var categoryID = $(this).val();
            if(categoryID) {
                cat_wise_subcat(categoryID);
            }
        });

        // City wise town
        $('#cityy').on('change', function() {
        var cityID = $(this).val();
            if(cityID) {
                city_wise_town(cityID);
            }else{
                $('#townn').empty();
            }
        });

        // cat wise subcat function
        function cat_wise_subcat(categoryID){
            axios.get('/get-sub-categories/'+categoryID).then((res => {
                if(res.data){
                    $('#ad_subcategory').empty();
                    // $('#ad_subcategory').append('<option value="" hidden>Select Subcategory</option>');
                    $.each(res.data, function(key, subcat){
                        $('select[name="subcategory_id"]').append('<option value="'+ subcat.id +'">' + subcat.name+ '</option>');
                    });
                }else{
                    $('#ad_subcategory').empty();
                }
            }))
        }

        // cat wise subcat function
        function city_wise_town(cityID){
            axios.get('/get-towns/'+cityID).then((res => {
                if(res.data){
                    $('#townn').empty();
                    $.each(res.data, function(key, town){
                        $('select[name="town_id"]').append('<option value="'+ town.id +'">' + town.name+ '</option>');
                    });
                }else{
                    $('#townn').empty();
                }
            }))
        }
    </script>
@endsection
