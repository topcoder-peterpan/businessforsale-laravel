<div class="{{ $className }}">
    <div class="cards cards--one {{  $ad->featured ? 'cards--highlight':'' }}">
        <a href="{{ route('frontend.addetails',$ad->slug) }}" class="cards__img-wrapper">
            @if ($ad->thumbnail)
                <img src="{{ asset($ad->thumbnail) }}" alt="card-img" class="img-fluid" />
            @else
                <img src="{{ asset('backend/image/default-ad.png') }}" alt="card-img" class="img-fluid" />
            @endif
        </a>
        <div class="cards__info">
            <div class="cards__info-top">
                <h6 class="text--body-4 cards__category-title">
                    <span class="icon">
                        <i class="{{ $ad->category->icon }}" style="font-size: 15px"></i>
                    </span>
                    {{ $ad->category->name }}
                </h6>
                <a href="{{ route('frontend.addetails',$ad->slug) }}" class="text--body-3-600 cards__caption-title">
                    {{ \Illuminate\Support\Str::limit($ad->title, 30, $end='...') }}
                </a>
            </div>
            <div class="cards__info-bottom">
                <h6 class="cards__location text--body-4">
                    <span class="icon">
                        <x-svg.location-icon width="20" height="20" stroke="#27C200" />
                    </span>
                    {{ $ad->city->name }}
                </h6>
                <span class="cards__price-title text--body-3-600">$ {{ $ad->price }} </span>
            </div>
        </div>
    </div>
</div>
