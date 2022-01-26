@extends('layouts.frontend.layout_one')

@section('title',__('website.sign_up'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->default_background_path">
        {{ __('website.sign_up') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.sign_up') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- registration section start   -->
    <section class="section registration">
        <div class="container">
            <div class="row">
                {{-- Signup Content  --}}
                <x-auth.content/>

                {{-- Signup Form --}}
                <x-auth.signup-form/>
            </div>
        </div>
    </section>
    <!-- registration section  end    -->
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/passwordType.js"></script>
@endsection
