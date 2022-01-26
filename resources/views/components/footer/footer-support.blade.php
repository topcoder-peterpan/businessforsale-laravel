<div class="col-xl-2 col-lg-2 col-sm-4 col-6">
    <h2 class="footer__title text--body-2-600">Supports</h2>

    <ul class="footer-menu">
        @if ($contact_enable)
        <li class="footer-menu__item">
            <a href="{{ route('frontend.contact') }}" class="footer-menu__link text--body-3">Contact</a>
        </li>
        @endif
        @if ($faq_enable)
            <li class="footer-menu__item">
                <a href="{{ route('frontend.faq') }}" class="footer-menu__link text--body-3">Faqs</a>
            </li>
        @endif
        <li class="footer-menu__item">
            <a href="{{ route('frontend.terms') }}" class="footer-menu__link text--body-3"> Terms & Condition</a>
        </li>
    </ul>
</div>
