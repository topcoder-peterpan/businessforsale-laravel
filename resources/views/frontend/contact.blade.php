@extends('layouts.frontend.layout_one')

@section('title',__('website.contact'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->contact_background_path">
        {{__('webiste.contact')}}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="#" class="breedcrumb__page-link text--body-3">{{ __('website.contact') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
<!-- breedcrumb section end  -->

<!-- Contact section start  -->
    @livewire('contact-component')
<!-- Contact section end -->

<div class="map">
    {!! $settings->map_address !!}
</div>
@endsection

@section('adlisting_style') @livewireStyles @endsection
@section('frontend_script') @livewireScripts @endsection
