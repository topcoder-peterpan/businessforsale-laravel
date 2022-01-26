@extends('layouts.frontend.layout_two')

@section('title', __('website.home'))

@section('content')
    <!-- Banner section start  -->
    <section class="banner banner--one section" style="background: url('{{ $cms->index2_search_filter_background_path }}') center center/cover no-repeat;">
        <div class="container">
            <h2 class="text--display-2 text-center banner__title animate__animated animate__bounceInDown">
                {{ __('website.browse_over') }} {{ $totalAds }} {{ __('website.classified_ads_listing') }}
            </h2>

            <!-- Search Box -->
            <x-frontend.adlist-search class="adlist-search" :categories="$categories" :towns="$towns" :dark="false"></x-frontend.adlist-search>

            <!-- Slider main container -->
            <div class="banner__feature-slider banner__feature">
                <!-- Slides -->
                @foreach ($topCategories as $category)
                <div class="banner__feature-item">
                    <div class="category-card">
                        <div class="category-card__icon">
                            <i class="{{ $category->icon }}" style="font-size: 55px"></i>
                        </div>
                        <h5 class="text--body-2 category-card__title">{{ $category->name }}</h5>
                        <div class="category-card__view">
                            <span class="first view-number">{{ $category->ad_count ?? 0 }}</span>
                            <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="second view-btn">
                                {{ __('website.view_ads') }}
                                <span class="icon">
                                    <x-svg.right-arrow-icon stroke="#00AAFF" />
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Banner section end  -->

    <!-- work section start  -->
    <x-others.how-it-work/>
    <!-- work section end -->

    <!-- feature section start  -->
    <section class="section feature-ads">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('website.featured_ads') }}
            </h2>
            <div class="row">
                @foreach ($featuredAds as $ad)
                    <x-frontend.single-left-image-ad :ad="$ad" classList="col-lg-6"></x-frontend.single-left-image-ad>
                @endforeach
            </div>
            @if (count($featuredAds) > 0)
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
    <!-- feature section end -->

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

    <!-- recent-post section start  -->
    <section class="section recent-post bgcolor--gray-10">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('website.recently_posted_ads') }}
            </h2>
            <div class="row">
                @foreach ($recentads as $recentad)
                    <x-frontend.single-ad :ad="$recentad" className="col-xl-3 col-md-6"></x-frontend.single-ad>
                @endforeach
            </div>
        </div>
    </section>
    <!-- recent-post section end -->

    @if ($priceplan_enable)
        <!-- membership-call section start  -->
        <section class="section membership-call">
            <div class="container">
                <div class="membership-call__content" style="background: url('{{ $cms->index2_get_membership_background_path }}') center center/cover no-repeat;">
                    <div class="membership-call__left">
                        <h2 class="text--heading-2 membership-call__title">{{ __('website.membership_header') }}</h2>
                        <p class="text--body-3 membership-call__description">
                            {{ __('website.membership_description') }}
                        </p>
                    </div>
                    <div class="membership-call__right">
                        <a href="{{ route('frontend.priceplan') }}" class="btn btn--lg">{{ __('website.get_membership') }}</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- membership-call section start  -->
    @endif

@endsection

@section('adlisting_style')
    <link rel="stylesheet"  href="{{ asset('frontend/css') }}/select2.min.css" />
    <link rel="stylesheet"  href="{{ asset('frontend/css') }}/select2-bootstrap-5-theme.css" />
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

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
    <script type="module" src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>

    <script>
        $(document).ready(function(){
            // ===== Select2 ===== \\
            $('#town').select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ?
                    $(this).data('width') :
                    $(this).hasClass('w-100') ?
                    '100%' :
                    'style',
                placeholder: 'Select town',
                allowClear: Boolean($(this).data('allow-clear')),
                closeOnSelect: !$(this).attr('multiple'),
            });
        });
    </script>
@endsection
