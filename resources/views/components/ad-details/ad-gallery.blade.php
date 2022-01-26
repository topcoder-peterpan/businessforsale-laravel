<div>
    <div class="product-item__gallery">
        <div
        style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
        class="swiper mySwiper2"
      >
        <div class="swiper-wrapper">
            @foreach ($galleries as $gallery)
                <div class="swiper-slide">
                    <img src="{{ asset($gallery->image) }}" alt="product-img" />
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="view">
            <a class="icon" href="{{ route('frontend.ad.gallery.details', $slug) }}">
                <x-svg.full-screen-icon />
            </a>
        </div>
      </div>
      <div thumbsSlider="" class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($galleries as $gallery)
            <div class="swiper-slide">
                <img src="{{ asset($gallery->image) }}" alt="product-img" />
            </div>
        @endforeach
          </div>
      </div>
    </div>
</div>
