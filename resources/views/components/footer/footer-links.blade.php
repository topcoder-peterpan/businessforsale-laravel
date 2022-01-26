<div class="col-xl-2 col-lg-2 col-sm-4 col-6">
    <h2 class="footer__title text--body-2-600">{{ __('website.quick_links') }}</h2>

    <ul class="footer-menu">
        <li class="footer-menu__item">
            <a href="{{ route('frontend.adlist') }}" class="footer-menu__link text--body-3">Ads</a>
        </li>
        <li class="footer-menu__item">
            <a href="{{ route('frontend.about') }}" class="footer-menu__link text--body-3">About</a>
        </li>
        @if ($blog_enable)
            <li class="footer-menu__item">
                <a href="{{ route('frontend.blog') }}" class="footer-menu__link text--body-3">Blog</a>
            </li>
        @endif
        @if ($priceplan_enable)
            <li class="footer-menu__item">
                <a href="{{ route('frontend.priceplan') }}" class="footer-menu__link text--body-3">Pricing Plans</a>
            </li>
        @endif
    </ul>
</div>
