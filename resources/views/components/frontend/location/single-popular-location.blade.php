<div class="location-card">
    <a href="{{ route('frontend.adlist.search',['city'=>$city->name]) }}" class="location-card__img-wrapper">
        <img class="rounded" src="{{ $city->image }}" alt="location">
    </a>
    <div class="location-card__info">
        <h2 class="location-card__loc-title text--body-2-600">{{ $city->name }}
        <div class="location-card__view">
            <span class="first view-number"> {{ $city->ad_count }} </span>
            <a href="{{ route('frontend.adlist.search',['city'=>$city->name]) }}" class="second view-btn">
                {{ __('website.view_ads') }}
                <span class="icon">
                    <x-svg.right-arrow-icon stroke="#00AAFF"/>
                </span>
            </a>
        </div>
    </h2></div>
</div>
