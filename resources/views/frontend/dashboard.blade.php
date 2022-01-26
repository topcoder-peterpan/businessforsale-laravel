@extends('layouts.frontend.layout_one')

@section('title',__('website.dashboard'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_overview_background_path">
        {{ __('website.overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}" class="breedcrumb__page-link text--body-3">{{ __('website.dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.overview') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard dashboard--user">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="dashboard__count-card row">
                        <div class="col-lg-4">
                            <div class="dashboard-card dashboard-card--count bgcolor--primary-9">
                                <div class="dashboard-card--count__info">
                                    <span class="counter-number text--heading-2"> {{ $posted_ads_count }} </span>

                                    <h2 class="counter-title text--body-3">{{ __('website.posted_ads') }}</h2>
                                </div>
                                <div class="dashboard-card--count__icon">
                                    <span class="icon">
                                        <x-svg.list-icon />
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-card dashboard-card--count bgcolor--success-9">
                                <div class="dashboard-card--count__info">
                                    <span class="counter-number text--heading-2"> {{ $favouriteadcount }} </span>
                                    <h2 class="counter-title text--body-3">{{ __('website.favorite_ads') }}</h2>
                                </div>
                                <div class="dashboard-card--count__icon">
                                    <span class="icon">
                                        <x-svg.favourite-icon />
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-card dashboard-card--count bgcolor--danger-9">
                                <div class="dashboard-card--count__info">
                                    <span class="counter-number text--heading-2"> {{ $expire_ads_count }} </span>
                                    <h2 class="counter-title text--body-3">{{ __('website.expire_ads') }}</h2>
                                </div>
                                <div class="dashboard-card--count__icon">
                                    <span class="icon">
                                        <x-svg.cube-icon />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row dashboard__ads-activity">
                        <div class="col-lg-6">
                            <div class="dashboard-card">
                                <div class="dashboard__section-info">
                                    <h2 class="dashboard-card__title">{{ __('website.ads_view') }}</h2>
                                    {{-- <ul class="history">
                                        <li class="history-item">
                                            <a href="#" class="history-link">
                                                This Week
                                                <span class="icon">
                                                    <x-svg.bottom-light-icon />
                                                </span>
                                            </a>
                                            <ul class="history-dropdown">
                                                <li class="history-dropdown__item">
                                                    <a href="#" class="history-dropdown__link">Previous Week</a>
                                                </li>
                                                <li class="history-dropdown__item">
                                                    <a href="#" class="history-dropdown__link">Last Month</a>
                                                </li>
                                                <li class="history-dropdown__item">
                                                    <a href="#" class="history-dropdown__link">Last years</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul> --}}
                                </div>
                                <canvas id="adsview" width="536" height="436"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <x-dashboard.activity-log :activities="$activities"/>
                        </div>
                    </div>
                    @if ($recent_ads->count() > 0)
                        <div class="dashboard__posted-ads">
                            <div class="dashboard__section-info">
                                <h2 class="dashboard-card__title">{{ __('website.recently_posted_ads') }}</h2>

                                <a href="{{ route('frontend.adlist') }}" class="view-page">
                                    {{ __('website.view_all') }}
                                    <span class="icon">
                                        <x-svg.right-arrow-icon stroke="#939AAD" />
                                    </span>
                                </a>
                            </div>
                            <div class="row dashboard__posted-ads-slider">
                                @foreach ($recent_ads as $ad)
                                    <div class="dashboard__posted-ads-slider--item">
                                        <div class="cards cards--one overflow-visible">
                                            <a href="{{ route('frontend.addetails', $ad->slug) }}" class="cards__img-wrapper">
                                                <img src="{{ $ad->thumbnail ? asset($ad->thumbnail) : asset('backend/image/default-ad.png') }}" alt="card-img" class="img-fluid" />
                                            </a>
                                            <div class="cards__info">
                                                <div class="cards__info-top">
                                                    <h6 class="text--body-4 cards__category-title">
                                                        <span class="icon">
                                                            <i class="{{ $ad->category->icon }}"></i>
                                                        </span>
                                                        {{ $ad->category->name }}
                                                    </h6>
                                                    <a href="{{ route('frontend.addetails', $ad->slug) }}" class="text--body-3-600 cards__caption-title">
                                                        {{ \Illuminate\Support\Str::limit($ad->title, 25, $end='...') }}
                                                    </a>
                                                </div>
                                                <div class="cards__info-bottom">
                                                    <span class="cards__price-title text--body-3-600">${{ $ad->price }} </span>
                                                    <ul class="edit">
                                                        <li class="edit-icon">
                                                            <span class="icon-toggle">
                                                                <x-svg.three-dots-icon />
                                                            </span>

                                                            <ul class="edit-dropdown">
                                                                <li class="edit-dropdown__item">
                                                                    <a href="{{ route('frontend.post.edit', $ad->slug) }}" class="edit-dropdown__link">
                                                                        <span class="icon">
                                                                            <x-svg.edit-icon />
                                                                        </span>
                                                                        <h5 class="text--body-4">{{ __('website.edit_ad') }}</h5>
                                                                    </a>
                                                                </li>
                                                                <li class="edit-dropdown__item">
                                                                    <x-dashboard.view-ad :ad="$ad"></x-dashboard.view-ad>
                                                                </li>
                                                                <li class="edit-dropdown__item">
                                                                    @if ($ad->status === 'expired')
                                                                        <x-dashboard.make-active :ad="$ad"/>
                                                                    @else
                                                                        <x-dashboard.make-expire :ad="$ad"/>
                                                                    @endif
                                                                </li>
                                                                <li class="edit-dropdown__item">
                                                                    <x-dashboard.delete-ad :ad="$ad"></x-dashboard.delete-ad>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection

@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
    <style>
        .dashboard-card--recent__activity-item {
            align-items: center !important;
        }
    </style>
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/chart.min.js"></script>

    <script>
        const ctx = document.querySelector('#adsview');

        // ===== chart ===== \\
        if (ctx) {
            ctx.getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: '',
                        data: {{ json_encode($bar_chart_datas) }},
                        backgroundColor: '#00aaff',
                        borderWidth: 0,
                        barThickness: 28,
                        borderRadius: 100,
                    }, ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });
        }

        // ==== Internation telephone  Code ===== \\
        // if (inputNumber) {
        //     window.intlTelInput(inputNumber, {
        //         preferredCountries: ['us', 'bd'],
        //     });
        // }

    </script>
@endsection
