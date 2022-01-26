<div class="col-xl-4 col-lg-6">
    <div class="plan-card {{ $plan->recommended ? 'plan-card--active':'' }}">
        <div class="plan-card__top">
            <h2 class="plan-card__title text--body-1"> {{ $plan->label }} </h2>
            <p class="plan-card__description">
                {{ $plan->description }}
            </p>
            <div class="plan-card__price">
                <h5 class="text--display-3">${{ $plan->price }}</h5>
            </div>
            @if (auth('customer')->check())
                <a href="{{ route('frontend.priceplanDetails',$plan->label) }}" class="plan-card__select-pack btn btn--bg w-100" >
                    {{ __('website.choose_plan') }}
                    <span class="icon--right">
                        <x-svg.right-arrow-icon />
                    </span>
                </a>
            @else
                <a href="{{ route('customer.login') }}" class="plan-card__select-pack btn btn--bg w-100" >
                    {{ __('website.choose_plan') }}
                    <span class="icon--right">
                        <x-svg.right-arrow-icon />
                    </span>
                </a>

            @endif
        </div>
        <div class="plan-card__bottom">
            <div class="plan-card__package">
                <div class="plan-card__package-list active">
                    <span class="icon">
                        <x-svg.check-icon />
                    </span>
                    <h5 class="text--body-3">{{ __('website.post') }} {{ $plan->ad_limit }} {{ __('website.ads') }}</h5>
                </div>
                <div class="plan-card__package-list  {{ $plan->multiple_image ? 'active':'' }} ">
                    <span class="icon">
                        <x-svg.check-icon />
                    </span>
                    <h5 class="text--body-3"> {{ __('website.multiple_images') }} </h5>
                </div>
                <div class="plan-card__package-list {{ $plan->featured_limit ? 'active':'' }}">
                    <span class="icon">
                        <x-svg.check-icon />
                    </span>
                    <h5 class="text--body-3">{{ $plan->featured_limit }} {{ __('website.featured_ads') }}</h5>
                </div>
                <div class="plan-card__package-list {{ $plan->customer_support ? 'active':'' }} ">
                    <span class="icon">
                        <x-svg.check-icon />
                    </span>
                    <h5 class="text--body-3">{{ __('website.basic_customer_support') }}</h5>
                </div>
                <div class="plan-card__package-list {{ $plan->badge? 'active':'' }} ">
                    <span class="icon">
                        <x-svg.check-icon />
                    </span>
                    <h5 class="text--body-3">{{ __('website.special_membership_badge') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
