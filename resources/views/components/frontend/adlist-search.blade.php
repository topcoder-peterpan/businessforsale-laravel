<form action="{{ route('frontend.adlist.search') }}" method="GET">
    <div class="ad-list__search-box">
        <div class="container">
            <!-- Search Box -->
            <div class="search {{ $dark ? 'search-no-borders border-0' : '' }}">

                    <div class="search__content">
                        <!-- search by keyword/title -->
                        <div class="search__content-item">
                            <div class="input-field {{ $dark ? 'input-field--transparent' : '' }}">
                                <input type="text" placeholder="Search by ads title, keyword..." name="keyword" value="{{ request('keyword','') }}" />
                                <span class="icon icon--left">
                                    <x-svg.search-icon />
                                </span>
                            </div>
                        </div>
                        <!-- Search By location -->
                        <div class="search__content-item">
                            <div class="input-field {{ $dark ? 'input-field--transparent' : '' }}">
                                <select name="town" id="town" style="width: calc(100% - 60px);">
                                    @php
                                        $town_names = explode(',', request('town'))
                                    @endphp
                                    <option value="" style="display: none;">{{ __('website.select_location') }}</option>
                                    @foreach ($towns as $town)
                                        <option value="{{ $town->name }}" {{ in_array($town->name, $town_names) ? 'selected': '' }}> {{ $town->name }} </option>
                                    @endforeach
                                </select>
                                <span class="icon icon--left">
                                    <x-svg.search-location-icon />
                                </span>
                            </div>
                        </div>
                        <!-- Select Category temprorary disable -->
                        <div class="search__content-item">
                            <div class="input-field {{ $dark ? 'input-field--transparent' : '' }}">
                                <select name="category" id="category" style="width: calc(100% - 60px);">
                                    @php
                                        $categories_slug = explode(',', request('category'))
                                    @endphp
                                    <option value="" style="display: none;">{{ __('website.select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}" {{ in_array($category->slug, $categories_slug) ? 'selected': '' }}> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                                <span class="icon icon--left">
                                    <x-svg.category-icon />
                                </span>
                            </div>
                        </div>
                        <!-- Search Btn -->
                        <div class="search__content-item">
                            <button class="btn btn--lg" type="submit">
                                <span class="icon--left">
                                    <x-svg.search-icon stroke="#fff"/>
                                </span>
                                {{ __('website.search') }}
                            </button>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    {{ $slot }}
</form>


