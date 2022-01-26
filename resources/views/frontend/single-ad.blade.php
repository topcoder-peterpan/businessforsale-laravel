@extends('layouts.frontend.layout_one')

@section('title')
{{ $ad->title }}
@endsection

@php
    $keywords = sprintf("%s, %s",$settings->seo_meta_keywords, join(', ',$ad->adFeatures->pluck('name')->all()));
@endphp

@section('meta')
    <meta name="title" content="{{ $ad->title }}">
    <meta name="description" content="{{ $ad->description }}">
    <meta name="keywords" content="{{ $keywords }}">

    <meta property="og:image" content="{{ $ad->thumbnail }}"/>
    <meta property="og:site_name" content="{{ $settings->name }}">
    <meta property="og:title" content="{{ $ad->title }}">
    <meta property="og:url" content="{{ route('frontend.addetails', $ad->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $ad->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ $settings->name }}" />
    <meta name=twitter:creator content="{{ $ad->customer->name }}" />
    <meta name=twitter:url content="{{ route('frontend.addetails', $ad->slug) }}" />
    <meta name=twitter:title content="{{ $ad->title }}" />
    <meta name=twitter:description content="{{ $ad->description }}" />
    <meta name=twitter:image content="{{ $ad->thumbnail }}" />
@endsection

@section('content')
<!-- breedcrumb section start  -->
<x-frontend.breedcrumb-component :background="$cms->ads_background_path">
    {{ $ad->title }}
    <x-slot name="items">
        <li class="breedcrumb__page-item">
            <a class="breedcrumb__page-link text--body-3">{{ $ad->title }}</a>
        </li>
    </x-slot>
</x-frontend.breedcrumb-component>
<!-- breedcrumb section end  -->

<!-- single ads section start  -->
<section class="product-item section">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                {{-- ad badge  --}}
                <x-ad-details.ad-badge :featured="$ad->featured" :customerid="$ad->customer_id" />

                {{-- ad info  --}}
                <x-ad-details.ad-info :ad="$ad" />

                {{-- ad gallery  --}}
                <x-ad-details.ad-gallery :galleries="$ad->galleries" :thumbnail="$ad->thumbnail" :slug="$ad->slug" />

                {{-- ad description  --}}
                <x-ad-details.ad-description :description="$ad->description" :features="$ad->adFeatures"/>
            </div>
            <div class="col-xl-4">
                <div class="product-item__sidebar">
                    <span class="toggle-bar">
                        <x-svg.toggle-icon />
                    </span>
                    <div class="product-item__sidebar-top">
                        {{-- ad wishlist  --}}
                        <x-ad-details.ad-wishlist :id="$ad->id" :price="$ad->price" />

                        {{-- ad contact  --}}
                        <x-ad-details.ad-contact :phone="$ad->phone" :name="$ad->customer->username" />

                        {{-- ad customer info  --}}
                        <x-ad-details.ad-customer-info :customer="$ad->customer" :town="$ad->town" :city="$ad->city" :link="$ad->website_link"/>
                    </div>
                    <div class="product-item__sidebar-bottom">
                        <div class="product-item__sidebar-item overview">
                            {{-- ad overview  --}}
                            <x-ad-details.ad-overview :ad="$ad" />

                            <p style="display-block;border-bottom: 1px solid #ebeef7"></p>

                            {{-- ad share --}}
                            <x-ad-details.ad-share :slug="$ad->slug" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- single ads section End  -->

<!-- related ads section start  -->
<x-ad-details.ad-related-item :lists="$lists" />
<!-- related ads section end  -->
@endsection
{{--
@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
<link rel="stylesheet" href="{{ asset('frontend/css') }}/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{ asset('frontend/css/productslider.css') }}" />
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/swiper-bundle.min.js"></script>
<script>
    function copyToClipboard() {
        let temp = $("<input>");
        $("body").append(temp);
        temp.val(window.location).select();
        document.execCommand("copy");
        temp.remove();

        alert("Copied to clipboard!");
    }

    var swiper = new Swiper(".mySwiper", {
  spaceBetween: 12,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {

    1024: {
      slidesPerView: 6,
    },
    1: {
      slidesPerView: 3,
    },
  },
});

var swiper2 = new Swiper(".mySwiper2", {
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});

</script>
@endsection --}}

@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />

<link rel="stylesheet" href="{{ asset('frontend/css') }}/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{ asset('frontend/css/productslider.css') }}" />
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>

<script src="{{ asset('frontend') }}/js/plugins/swiper-bundle.min.js"></script>
<script src="{{ asset('frontend') }}/js/swiperslider.config.js"></script>
@stack('ad_scripts')
@endsection
