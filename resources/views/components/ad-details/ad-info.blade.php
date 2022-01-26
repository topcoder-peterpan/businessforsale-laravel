<div class="product-item__ads-info">
    <h2 class="text--heading-2 title">{{ $ad->title }}</h2>

    <ul class="post-details">
        <li class="post-details__item">
            <span class="icon">
                <x-svg.location-icon />
            </span>
            <p class="text--body-3">{{ $ad->city->name }}, {{ $ad->town->name }}</p>
        </li>
        <li class="post-details__item">
            <span class="icon">
                <x-svg.clock-icon width="24" height="24" stroke="#767E94" />
            </span>
            <p class="text--body-3">{{ \Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</p>
        </li>
        <li class="post-details__item">
            <span class="icon">
                <x-svg.eye-icon stroke="#767E94" />
            </span>
            <p class="text--body-3">{{ $ad->total_views }} {{ __('website.viewed') }}</p>
        </li>
    </ul>
</div>
