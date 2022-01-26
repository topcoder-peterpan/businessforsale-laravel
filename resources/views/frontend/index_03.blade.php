@extends('layouts.frontend.layout_three')

@section('title', __('website.home'))

@section('frontend_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/select2.min.css" />
<link rel="stylesheet" href="{{ asset('frontend/css') }}/select2-bootstrap-5-theme.css" />
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />

    @if (auth('customer')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit)
        <style>
            .header--one {
                top: 50px !important;
            }
            .header--fixed {
                top: 0 !important;
            }
        </style>
    @endif
@endsection

@section('content')
<!-- Banner section start  -->
<div class="banner banner--three"
    style="background:url('{{ $cms->index3_search_filter_background_path }}') center center/cover no-repeat;">
    <div class="container">
        <span class="banner__tag text--body-2-600">{{ __('website.over') }} {{ $totalAds }} {{ __('website.live_ads') }}</span>
        <div class="banner__title text--display-2 animate__animated animate__bounceInDown">
            {{ __('website.banner_title') }}
        </div>
        <!-- Search Box -->
        <x-frontend.adlist-search class="adlist-search" :categories="$categories" :towns="$towns" :dark="true">
        </x-frontend.adlist-search>
    </div>
</div>
<!-- Banner section end   -->

<!-- Poupular category Section start  -->
<section class="section popular-category">
    <div class="container">
        <h2 class="text--heading-1 section__title">{{ __('website.popular_category') }}</h2>
        <div class="row">
            @foreach ($topCategories as $category)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="category-card">
                    <div class="category-card__icon">
                        <i class="{{ $category->icon }}" style="font-size: 40px"></i>
                    </div>
                    <a href="{{ route('frontend.adlist.category.show', $category->slug) }}">
                        <h5 class="text--body-2 category-card__title"> {{ $category->name }} </h5>
                    </a>
                    <div class="category-card__view">
                        <span class="first view-number"> {{ $category->ad_count ?? 0 }} Ads</span>
                        <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="second view-btn">
                            {{ __('website.view_ads') }}
                            <span class="icon">
                                <x-svg.right-arrow-icon stroke="#00AAFF"/>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Poupular category Section end  -->

<!-- recent post Section start  -->
<section class="section recent-post">
    <div class="container">
        <h2 class="text--heading-1 section__title">{{ __('website.our_popular_ads') }}</h2>
        <div class="row">
            @foreach ($recentads as $ad)
            <x-frontend.single-ad :ad="$ad" className="col-xl-3 col-md-6"></x-frontend.single-ad>
            @endforeach
        </div>
            @if (count($newestAds) > 0)
            <div class="recent-post__btn">
                <a href="{{ route('frontend.adlist') }}" class="btn">
                    {{ __('website.view_all') }}
                    <span class="icon--right">
                        <x-svg.right-arrow-icon />
                    </span>
                </a>
            </div>
            @endif
    </div>
</section>
<!-- recent post Section end  -->


<!-- How to work Section start  -->
<x-others.how-it-work />
<!-- How to work Section end  -->

<!-- Featured Ads Section start  -->
<section class="section feature-ads">
    <div class="container">
        <h2 class="text--heading-1 section__title">
            {{ __('website.newest_ads') }}
        </h2>

        <div class="row">
            @foreach ($newestAds as $ad)
            <x-frontend.single-left-image-ad :ad="$ad" classList="col-lg-6"></x-frontend.single-left-image-ad>
            @endforeach
        </div>
        @if (count($newestAds) > 0)
        <div class="feature-ads__btn">
            <a href="{{ route('frontend.adlist') }}" class="btn">
                {{ __('website.view_all') }}
                <span class="icon--right">
                    <x-svg.right-arrow-icon />
                </span>
            </a>
        </div>
        @endif
    </div>
</section>
<!-- Featured Ads Section start  -->

<!-- popular-loc section start  -->
<section class="section popular-location">
    <div class="container">
        <h2 class="text--heading-1 section__title">
            {{ __('website.popular_location') }}
        </h2>
        <div class="row">
            @foreach ($topCities as $city)
            <div class="col-xl-3 col-md-6">
                <x-frontend.location.single-popular-location :city="$city"></x-frontend.location.single-popular-location>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- popular-loc section end -->

<!-- price-plan section start  -->
<section class="section price-plan">
    <div class="container">
        <h2 class="price-plan__title text--heading-1">{{ __('website.membership_title') }}</h2>
        <p class="price-plan__brief text--body-3">{{ __('website.membership_content') }}</p>
        <div class="tab-content" id="nav-tabContent">
            <!-- Monthly -->
            <div class="tab-pane fade show active" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                <div class="row">
                    @forelse ($plans as $plan)
                    <x-others.single-plan :plan="$plan" />
                    @empty
                    <x-no-data-found/>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- price-plan section end  -->

<!-- newsletter subscription  -->
@if ($newsletter_enable)
    @include('layouts.frontend.partials.newsletter')
@endif

@endsection


@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // ===== Select2 ===== \\
        $('#town').select2({
            theme: 'bootstrap-5',
            width: $(this).data('width') ?
                $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style',
            placeholder: 'Select town',
            allowClear: Boolean($(this).data('allow-clear')),
            closeOnSelect: !$(this).attr('multiple'),
        });
    });
</script>
@stack('newslater_script')
@endsection
