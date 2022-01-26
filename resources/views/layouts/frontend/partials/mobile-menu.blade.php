<ul class="menu--sm">
    <li class="menu--sm__item">
        <a href="{{ route('frontend.index') }}" class="menu--sm__link">Home</a>
    </li>
    <li class="menu--sm__item">
        <a href="{{ route('frontend.adlist') }}" class="menu--sm__link">Ads</a>
    </li>
    @if ($blog_enable)
        <li class="menu--sm__item">
            <a href="{{ route('frontend.blog') }}" class="menu--sm__link">Blog</a>
        </li>
    @endif
    @if ($priceplan_enable)
        <li class="menu--sm__item">
            <a href="{{ route('frontend.pricepla') }}" class="menu--sm__link">Pricing</a>
        </li>
    @endif
</ul>
