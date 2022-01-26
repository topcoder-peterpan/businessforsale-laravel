<div class="col-xl-3">
    <div class="footer__brand-logo">
        @if ($logotype === 'dark')
        <img style="
            height: 48px;
            width: 182px;" src="{{ asset($settings->logo_image2) }}" alt="logo-brand" />
        @else
        <img style="
            height: 48px;
            width: 182px;" src="{{ asset($settings->logo_image) }}" alt="logo-brand" />
        @endif
    </div>
    <div class="footer__loc-info">
        <p class="text--body-3">
            {{ $settings->address }}
        </p>
        <p class="text--body-3 phone">
            {{ __('website.phone') }}: {{ $settings->phone }}
        </p>
        <p class="text--body-3 email">
            {{ __('website.mail') }}: {{ $settings->email }}
        </p>
    </div>
</div>
