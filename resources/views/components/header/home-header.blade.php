<header class="header header--two">
    <div class="navigation-bar__top">
        <div class="container">
            <div class="navigation-bar">
                 <!-- Brand Logo -->
                <a href="{{ route('frontend.index') }}" class="navigation-bar__logo">
                    <img src="{{ asset($settings->logo_image) }}"  alt="brand-logo" class="logo-dark">
                </a>
                <!-- Search Field -->
                <form action="{{ route('frontend.adlist.search') }}" method="GET">
                    <div class="navigation-bar__search-field">
                        <input type="text" placeholder="Ads tittle, keyword... " name="keyword">
                        <button type="submit" class="navigation-bar__search-icon">
                            <x-svg.search-icon />
                        </button>
                    </div>
                </form>
                <!-- Action Buttons -->
                <div class="navigation-bar__buttons">
                    @if (auth('customer')->check())
                        <a href="{{ route('frontend.dashboard') }}" class="user">
                            <div class="user__img-wrapper">
                                @if (auth('customer')->user()->image)
                                    <img src="{{ asset(auth('customer')->user()->image) }}" style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                                @else
                                    <img src="{{ asset('backend/image/default.png') }}" style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                                @endif
                            </div>
                        </a>
                        <a href="{{ route('frontend.post') }}" class="btn">
                            <span class="icon--left">
                                <x-svg.image-select-icon />
                            </span>
                            {{ __('website.post_ads') }}
                        </a>
                    @else
                        <a href="{{ route('customer.login') }}" class="btn btn--bg">Sign in</a>
                        <a href="{{ route('customer.login') }}" onclick="return confirm('You need to login to post ad. Do you want to login?')" class="btn">
                            <span class="icon--left">
                                <x-svg.image-select-icon />
                            </span>
                            {{ __('website.post_ads') }}
                        </a>
                    @endif

                </div>

                <!-- Responsive Navigation Menu -->
                <button class="toggle-icon">
                    <span class="toggle-icon__bar"></span>
                    <span class="toggle-icon__bar"></span>
                    <span class="toggle-icon__bar"></span>
                </button>
                <ul class="menu--sm">
                    <li class="menu--sm__item">
                        <a href="{{ route('frontend.index') }}" class="menu--sm__link active">
                            {{ __('website.home') }}
                        </a>
                    </li>
                    <li class="menu--sm__item">
                        <a href="#" class="menu--sm__link">
                            {{ __('website.all_category') }}
                            <span class="icon">
                                <x-svg.category-arrow-icon />
                            </span>
                        </a>
                        <ul class="menu--sm-dropdown">
                            @foreach ($footer_categories as $category)
                            <li class="menu--sm-dropdown__item">
                                <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="menu--sm-dropdown__link">{{ $category->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @foreach ($top_categories as $category)
                        <li class="menu--sm__item">
                            <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="menu--sm__link">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="container navigation-bar__bottom">
        <!-- category menu -->
        <ul class="category-menu">
            <li class="category-menu__item">
                <a href="#" class="category-menu__link">
                    {{ __('website.all_category') }}
                    <span class="icon">
                        <x-svg.category-arrow-icon />
                    </span>
                </a>
                <ul class="category-menu__dropdown">
                    @foreach ($categories as $category)
                        <li class="category-menu__dropdown__item">
                            <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="category-menu__dropdown__link">
                                <i class="category-icon {{ $category->icon }}" style="color: #66CCFF"></i>
                                {{ $category->name }}
                                <span class="drop-icon">
                                    <x-svg.category-right-icon />
                                </span>
                            </a>
                            <ul class="category-menu__subdropdown">
                                @foreach ($category->subcategories as $subcategory)
                                    <li class="category-menu__subdropdown__item">
                                        <a href="{{ route('frontend.adlist.category.show', $subcategory->slug) }}" class="category-menu__subdropdown__link">{{ $subcategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <!-- Category Item -->
        <ul class="categories">
            @foreach ($top_categories as $category)
            <li class="categories__item">
                <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="categories__link {{ request()->routeIs('frontend.index') ? 'active' : '' }} ">{{ $category->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</header>
