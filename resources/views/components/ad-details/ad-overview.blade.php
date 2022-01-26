<div>
    <h2 class="text--body-1">{{ __('website.overview') }}</h2>
    <ul class="overview-details">
        <li class="overview-details__item">
            <span class="text--body-3 title">{{ __('website.conditions') }}:</span>
            <span class="text--body-3 info">{{ $ad->condition }}</span>
        </li>
        <li class="overview-details__item">
            <span class="text--body-3 title">{{ __('website.brand') }}:</span>
            <span class="text--body-3 info">{{ $ad->brand->name }}</span>
        </li>
        <li class="overview-details__item">
            <span class="text--body-3 title">{{ __('website.model') }}:</span>
            <span class="text--body-3 info">{{ $ad->model }}</span>
        </li>
        <li class="overview-details__item">
            <span class="text--body-3 title">{{ __('website.authenticity') }}:</span>
            <span
                class="text--body-3 info">{{ $ad->authenticity ? "Orginal":"Refurbished"  }}</span>
        </li>
    </ul>
</div>
