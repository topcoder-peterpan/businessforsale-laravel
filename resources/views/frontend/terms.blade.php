@extends('layouts.frontend.layout_one')

@section('title', __('website.terms_condition'))

@section('content')
     <!-- breedcrumb section start  -->
     <x-frontend.breedcrumb-component :background="$cms->terms_background_path">
        {{ __('website.terms_condition') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.terms_condition') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- faq section start  -->
    <section class="faq section">
        <div class="container">
            <div class="row justify-content-center">
               {!! $cms->terms_body ?? 'No terms & conditions found' !!}
            </div>
        </div>
    </section>
    <!-- faq section end   -->
@endsection
