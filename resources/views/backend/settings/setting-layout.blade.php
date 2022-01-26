@extends('layouts.backend.admin')
@section('title') {{ __('website_setting') }} @endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link {{ request()->page == 'website' ? 'active' : '' }}"
                        href="{{ route('setting.index', 'website') }}">{{ __('website') }}</a>
                    <a class="nav-link {{ request()->page == 'layout' ? 'active' : '' }}"
                        href="{{ route('setting.index', 'layout') }}">{{ __('layout') }}</a>
                    <a class="nav-link {{ request()->page == 'color' ? 'active' : '' }}"
                        href="{{ route('setting.index', 'color') }}">{{ __('color_picker') }}</a>
                    <a class="nav-link {{ request()->page == 'custom' ? 'active' : '' }}"
                        href="{{ route('setting.index', 'custom') }}">{{ __('custom_css_js') }}</a>
                    <a class="nav-link {{ request()->page == 'mail' ? 'active' : '' }}"
                        href="{{ route('setting.index', 'mail') }}">{{ __('mail') }}</a>
                    <a class="nav-link {{ request()->page == 'payment' ? 'active' : '' }}"
                            href="{{ route('setting.index', 'payment') }}">{{ __('payment') }}</a>
                    <a class="nav-link {{ request()->page == 'module' ? 'active' : '' }}"
                            href="{{ route('setting.index', 'module') }}">{{ __('module') }}</a>
                    <a class="nav-link {{ request()->page == 'seo' ? 'active' : '' }}"
                            href="{{ route('setting.index', 'seo') }}">{{ __('seo') }}</a>
                    <a class="nav-link {{ request()->page == 'cms' ? 'active' : '' }}"
                            href="{{ route('setting.index', 'cms') }}">{{ __('cms') }}</a>
                    <a class="nav-link {{ request()->page == 'social_login' ? 'active' : '' }}"
                            href="{{ route('setting.index', 'social_login') }}">{{ __('social_login') }}</a>
                </div>
            </div>
            <div class="col-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade {{ request()->page == 'website' ? 'show active' : '' }}">
                        @yield('website-settings')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'layout' ? 'show active' : '' }}" id="layout"
                        role="tabpanel" aria-labelledby="homee">
                        @yield('layout')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'color' ? 'show active' : '' }}">
                        @yield('color-picker')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'custom' ? 'show active' : '' }}" id="custom"
                        role="tabpanel" aria-labelledby="homee">
                        @yield('custom-setting')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'mail' ? 'show active' : '' }}" id="maill"
                        role="tabpanel" aria-labelledby="homee">
                        @yield('mail-setting')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'payment' ? 'show active' : '' }}" id="payment"
                        role="tabpanel" aria-labelledby="homee">
                        @yield('payment-setting')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'module' ? 'show active' : '' }}" id="module"
                        role="tabpanel" aria-labelledby="homee">
                        @yield('module-setting')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'seo' ? 'show active' : '' }}" id="seo"
                        role="tabpanel" aria-labelledby="homee">
                        @yield('seo-setting')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'cms' ? 'show active' : '' }}" id="cms"
                        role="tabpanel" aria-labelledby="cms">
                        @yield('cms-setting')
                    </div>
                    <div class="tab-pane fade {{ request()->page == 'social_login' ? 'show active' : '' }}" id="social_login"
                        role="tabpanel" aria-labelledby="homee">
                        @yield('social-login-setting')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
