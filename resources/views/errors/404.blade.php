@extends('layouts.frontend.layout_one')

@section('title','404')

@section('content')
    <!-- breedcrumb section start  -->
    <section class="breedcrumb" style="background: url('{{ asset('frontend/images/bg/bg-04.jpg') }}') center center/cover no-repeat;">
        <div class="container">
            <h2 class="breedcrumb__title text--heading-2">{{ __('website.error_page') }}</h2>
            <ul class="breedcrumb__page">
                <li class="breedcrumb__page-item">
                    <a href="index.html" class="breedcrumb__page-link text--body-3">Home</a>
                </li>
                <li class="breedcrumb__page-item">
                    <a href="#" class="breedcrumb__page-link text--body-3">/</a>
                </li>
                <li class="breedcrumb__page-item">
                    <a href="#" class="breedcrumb__page-link text--body-3">{{ __('website.error_page') }}</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- breedcrumb section end  -->

    <!-- Error section start  -->
    <section class="section error text-center">
        <div class="container">
            <div class="error__img-wrapper">
                <img src="{{ asset('frontend/images/bg/error.png') }}" alt="error" />
            </div>
            <h2 class="error__title text--heading-1">{{ __('website.not_found_title') }}</h2>
            <p class="error__brief text--body-3">
                {{ __('website.not_found_description') }}
            </p>
            <a href="{{ route('frontend.index') }}" class="error__back-btn btn">
                <span class="icon--left">
                    <x-svg.left-arrow-icon stroke="white" />
                </span>
                {{ __('website.go_back_home') }}
            </a>
        </div>
    </section>
    <!-- Error section end   -->
@endsection
