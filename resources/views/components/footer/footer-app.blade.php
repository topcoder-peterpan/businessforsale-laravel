<div class="col-xl-4 col-lg-6">
    @if ($settings->android || $settings->ios)
    <h2 class="footer__title text--body-2-600">{{ __('website.download_out_app') }}p</h2>
    @endif
    <div class="footer__mobile-app">

        @if ($settings->android)
        <a target="_blank" href="{{ asset($settings->android) }}" class="app">
            <div class="app-logo">
               <x-svg.google-play-icon />
            </div>
            <div class="app-info">
                <h5 class="text--body-5">{{ __('website.get_it_now') }}</h5>
                <h2 class="text--body-3-600">{{ __('website.google_play') }}</h2>
            </div>
        </a>
        @endif

        @if ($settings->ios)
        <a target="_blank" href="{{ asset($settings->ios) }}" class="app">
            <div class="app-logo">
                <x-svg.apple-icon />
            </div>
            <div class="app-info">
                <h5 class="text--body-5">{{ __('website.get_it_now') }}</h5>
                <h2 class="text--body-3-600">{{ __('website.app_store') }}</h2>
            </div>
        </a>
        @endif
    </div>
    <x-footer.footer-social/>
</div>
