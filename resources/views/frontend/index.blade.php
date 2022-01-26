
@extends('layouts.frontend.layout_one')

@section('title', __('website.home'))

@section('frontend_style')
    @livewireStyles
@endsection


@section('content')
    <!-- banner section start  -->
    <div class="banner banner--two" style="background: url('{{ $cms->index1_main_banner_path }}') center center/cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="text--display-3 banner__title animate__animated animate__bounceInDown">{{ __('website.banner_header') }}</h2>
                    <p class="text--body-3 banner__brief">
                        {{ __('website.banner_description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- banner section end   -->

    <!-- recent-post section start  -->
    <section class="section recent-post">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('website.recommended_ads') }}
            </h2>
            <div class="row">
                @forelse ($recommendedAds as $ad)
                    <x-frontend.single-ad :ad="$ad" className="col-xl-3 col-md-6"></x-frontend.single-ad>
                @empty
                   <x-no-data-found/>
                @endforelse
            </div>
            @if (count($recommendedAds) > 0)
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
    <!-- recent-post section end -->

    <!-- top-category section start  -->
    <section class="section top-category bgcolor--gray-10">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('website.top_category') }}
            </h2>
            <div class="row">
                @forelse ($topCategories as $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="categorylist-card">
                            <div class="categorylist-card__top">
                                <div class="categorylist-card__top-left">
                                    <h2 class="categorylist-card__title text--body-2-600"> {{ $category->name }} </h2>
                                    <span class="categorylist-card__item-available">({{ $category->ad_count ?? 0 }})</span>
                                </div>
                                <div class="categorylist-card__top-right">
                                    <div class="categorylist-card__icon">
                                        <i class="{{ $category->icon }}" style="font-size: 55px"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="categorylist-card__bottom">
                                <ul class="categorylist-card__list">
                                    @forelse ($category->subcategories as $subcategory)
                                        <li class="categorylist-card__list-item">
                                            <a href="{{ route('frontend.adlist.category.show', $subcategory->slug) }}" class="categorylist-card__list-link text--body-3">
                                                <span class="icon">
                                                    <x-svg.right-regular-icon />
                                                </span>
                                                {{ $subcategory->name }}
                                            </a>
                                        </li>
                                    @empty
                                    <div class="text-center">
                                        {{ __('website.no_subcategory_found') }}
                                    </div>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                <x-no-data-found/>
                @endforelse
            </div>
        </div>
    </section>
    <!-- top-category section end  -->

    <!-- popular-loc section start  -->
    <section class="section popular-location">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('website.popular_location') }}
            </h2>
            <div class="row">
                @forelse ($topCities as $city)
                    <div class="col-xl-3 col-md-6">
                        <x-frontend.location.single-popular-location :city="$city"></x-frontend.location.single-popular-location>
                    </div>
                @empty
                <x-no-data-found/>
                @endforelse
            </div>
        </div>
    </section>
    <!-- popular-loc section end -->

   <x-frontend.counter :totalAds="$totalAds" :verifiedUser="$verified_users" :proMember="$pro_members_count" :cityLocation="$city_count"></x-frontend.counter>

    <!-- download section start  -->
    @if ($settings->android || $settings->ios)
    <section class="download section pb-lg-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ $cms->index1_mobile_app_banner_path }}" class="download__img-content w-100" />
                </div>
                <div class="col-lg-6">
                    <div class="download__content">
                        <h2 class="download__title text--heading-1">{{ __('website.app_header') }}</h2>
                        <p class="download__brief text--body-2">
                            {{ __('website.app_description') }}
                        </p>
                        <div class="download__apps-store">
                            @if ($settings->android)
                            <a target="_blank" href="{{ asset($settings->android) }}" class="app">
                                <div class="app-logo">
                                    <x-svg.google-play-icon />
                                </div>
                                <div class="app-info">
                                    <h5 class="text--body-5">{{ __('website.get_it_now') }}</h5>
                                    <h2 class="text--body-3-600">{{ __('website.google_play') }}</h2>
                                </div>
                            </a>
                            @endif

                            @if ($settings->ios)
                            <a target="_blank" href="{{ asset($settings->ios) }}" class="app">
                                <div class="app-logo">
                                    <x-svg.apple-icon />
                                </div>
                                <div class="app-info">
                                    <h5 class="text--body-5">{{ __('website.get_it_now') }}</h5>
                                    <h2 class="text--body-3-600">{{ __('website.app_store') }}</h2>
                                </div>
                            </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="mb-5">
    </section>
    @endif
    <!-- download section end  -->

    @if ($newsletter_enable)
        @include('layouts.frontend.partials.newsletter')
    @endif
@endsection

@section('frontend_script')
<script type="module" src="{{ asset('frontend') }}/js/plugins/purecounter.js"></script>
@stack('newslater_script')

@endsection
