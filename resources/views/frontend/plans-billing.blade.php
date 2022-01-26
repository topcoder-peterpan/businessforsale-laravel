@extends('layouts.frontend.layout_one')

@section('title', __('website.price_and_billing'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_plan_background_path">
        {{ __('website.overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}" class="breedcrumb__page-link text--body-3">{{ __('website.dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.plans_billing') }}</a>
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
                    <div class="row dashboard__bill-two">
                        <div class="col-lg-7">
                            <div class="dashboard-card dashboard-card--benefits">
                                <h2 class="dashboard-card__title">{{ __('website.plan_benefits') }}</h2>

                                <ul class="dashboard__benefits">
                                    <li class="dashboard__benefits-left">
                                        <ul>
                                            <li class="dashboard__benefits-item">
                                                <span class="icon">
                                                    <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                </span>
                                                <p class="text--body-4">{{ __('website.ads_remaining') }}
                                                    <span class="{{ $plan_info->ad_limit <= 5 ? 'text-danger':'text-success'  }}">{{ $plan_info->ad_limit }}</span>
                                                </p>
                                            </li>

                                            <li class="dashboard__benefits-item">
                                                <span class="icon">
                                                    <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                </span>
                                                <p class="text--body-4">{{ __('website.multiple_images') }}</p>
                                            </li>
                                            @if ($plan_info->customer_support)
                                                <li class="dashboard__benefits-item">
                                                    <span class="icon">
                                                        <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                    </span>
                                                    <p class="text--body-4">{{ __('website.customer_support') }}</p>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="dashboard__benefits-right">
                                        <ul>
                                            <li class="dashboard__benefits-item">
                                                <span class="icon">
                                                    <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                </span>
                                                <p class="text--body-4">{{ __('website.featured_ads_remaining') }}
                                                    <span class="{{ $plan_info->featured_limit <= 2 ? 'text-danger':'text-success'  }}">{{ $plan_info->featured_limit }}</span>
                                                </p>
                                            </li>
                                            @if ($plan_info->badge)
                                                <li class="dashboard__benefits-item">
                                                    <span class="icon">
                                                        <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                    </span>
                                                    <p class="text--body-4">{{ __('website.special_membership_badge') }}</p>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="dashboard-card dashboard-card--invoice">
                                <h2 class="dashboard-card__title">{{ __('website.upgrade_plan') }}</h2>
                                <div class="dashboard-card--invoice-info">
                                    <div class="action">
                                        <a href="{{ route('frontend.priceplan') }}" class="btn">{{ __('website.upgrade_plan') }}</a>
                                    </div>
                                </div>
                                <span class="dashboard-card--invoice__icon">
                                    <x-svg.invoice-icon />
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row dashboard__bill-three">
                        <div class="col-lg-12">
                            <div class="dashboard-card dashboard-card--recentvoice">
                                <h2 class="dashboard-card__title">{{ __('website.recent_invoice') }}</h2>
                                <div class="dashboard-card--recentvoice__history">
                                    <div class="header-top">
                                        <div class="header-top-item">
                                            <h6 class="text--body-4">{{ __('website.transaction_id') }}</h6>
                                        </div>
                                        <div class="header-top-item">
                                            <h6 class="text--body-4">{{ __('website.plan_type') }}</h6>
                                        </div>
                                        <div class="header-top-item">
                                            <h6 class="text--body-4">{{ __('website.payment_type') }}</h6>
                                        </div>
                                        <div class="header-top-item">
                                            <h6 class="text--body-4">{{ __('website.amount') }}</h6>
                                        </div>
                                        <div class="header-top-item">
                                            <h6 class="text--body-4">{{ __('website.date') }}</h6>
                                        </div>
                                    </div>
                                    <div class="body">
                                        @forelse ($transactions as $transaction)
                                            <div class="body-item">
                                                <p class="text--body-4" style="margin-right: 5px">{{ $transaction->payment_id }}</p>
                                                <p class="amount text--body-4">{{ $transaction->plan->label }}</p>
                                                <p class="payment-type text--body-4">{{ $transaction->payment_type }}</p>
                                                <p class="text--body-4">${{ $transaction->amount }}</p>
                                                <p class="date text--body-4">{{  Carbon\Carbon::parse($transaction->created_at)->format('M d, Y g:i A')  }}</p>
                                            </div>
                                        @empty
                                        <x-not-found2 message="No recent invoice found"/>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->

@endsection


@section('frontend_style')
<style>
    .header-table {
        position: relative;
        min-height: 45px;
        -webkit-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
    }
    .dashboard-card--recentvoice__history .header-table {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
</style>
@endsection
