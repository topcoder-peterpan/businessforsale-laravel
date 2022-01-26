<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="title" content="{{ $settings->seo__meta_title }}">
        <meta name="description" content="{{ $settings->seo_meta_description }}">
        <meta name="keywords" content="{{ $settings->seo_meta_keywords }}">
    @endif


    {{-- <title>@yield('title') - {{ env('APP_NAME') }}</title> --}}
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($settings->favicon_image) }}" />
    <link rel="manifest" href="{{ asset('frontend/images/favicon_io/site.webmanifest') }}" />
    <link rel="stylesheet"  href="{{ asset('frontend/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />

    {{-- toastr notification --}}
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- Custom header css & script  --}}
    @yield('adlisting_style')
    @yield('frontend_style')

    <style>
        .category-menu__subdropdown__item {
            width: 270px !important;
        }
        .navigation-bar__buttons .user{
            margin: 0px 24px;
        }

        a.categories__link.active{
            color: #000 !important;
            transition: all 0.3s linear;
            font-weight: 800;
        }
        .subscribe__input-group.is-invalid{
            border: 1px solid red;
        }
    </style>

     {!! $settings->header_css !!}
     {!! $settings->header_script !!}
     <link rel="stylesheet"  href="{{ asset('frontend/css') }}/main.css">

</head>

<body>
     <!-- Top bar start  -->
     @if (auth('customer')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit)
        @include('layouts.frontend.partials.top-bar')
    @endif
    <!-- Top bar end  -->

    <!-- loader start  -->
    @include('layouts.frontend.partials.loader')
    <!-- loader end  -->

    @if (request()->route()->getName() === 'frontend.index')
        <!-- header start  -->
        <x-header.home-header />
        <!-- header end  -->
    @else
        <!-- Main header start  -->
        <x-header.main-header />
        <!-- Main header end  -->
    @endif

    @yield('content')

    <!-- footer section start  -->
    <x-footer.footer-top/>
    <!-- footer section end -->

    <!-- Back To Top Btn Start-->
    @include('layouts.frontend.partials.back-to-top')
    <!-- Back To Top Btn End-->

    <!-- Scripts goes here -->
    <script src="{{ asset('frontend') }}/js/plugins/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/bootstrap.bundle.min.js"></script>

    {{-- toastr notificaiton --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"> </script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}", 'Success!')
        @elseif(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}", 'Warning!')
        @elseif(Session::has('error'))
            toastr.error("{{ Session::get('error') }}", 'Error!')
        @endif
        // toast config
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "hideMethod": "fadeOut"
        }
    </script>

{{-- Custom footer script  --}}
@yield('frontend_script')
{!! $settings->body_script !!}
<script type="module" src="{{ asset('frontend') }}/js/plugins/app.js"></script>

</body>
</html>
