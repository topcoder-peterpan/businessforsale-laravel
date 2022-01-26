@extends('layouts.frontend.layout_one')

@section('title', __('website.price_and_plan'))

@section('content')
<!-- breedcrumb section start  -->
<x-frontend.breedcrumb-component :background="$cms->pricing_plan_background_path">
    {{ __('website.price_plan') }}
    <x-slot name="items">
        <li class="breedcrumb__page-item">
            <a class="breedcrumb__page-link text--body-3">{{ __('website.price_plan') }}</a>
        </li>
    </x-slot>
</x-frontend.breedcrumb-component>
<!-- breedcrumb section end  -->

<!-- price-plan section start  -->
<section class="section price-plan">
    <div class="container">
        <h2 class="price-plan__title text--heading-1">{{ __('website.membership_title') }}</h2>
        <p class="price-plan__brief text--body-3">{{ __('website.get_customer_services_description') }}</p>
        <div class="tab-content" id="nav-tabContent">
            <!-- Monthly -->
            <div class="tab-pane fade show active" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                <div class="row">
                    @forelse ($plans as $plan)
                        <x-others.single-plan :plan="$plan"/>
                    @empty
                    <x-no-data-found/>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- price-plan section end  -->
@endsection

@section('frontend_script')
<script type="module" src="{{ asset('frontend') }}/js/plugins/bvselect.js"></script>
@endsection
