@extends('layouts.frontend.layout_one')

@section('title')
'{{ $category->name }}' {{ __('website.wise_ads') }}
@endsection

@section('content')
    <!-- recent-post section start  -->
    <section class="section recent-post">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                '{{ $category->name }}' {{ __('website.wise_ads') }}
            </h2>
            <div class="ad-list__content row">
                @forelse ($adlistings as $ad)
                    <x-frontend.single-ad :ad="$ad" :category="$category" className="col-lg-3 col-md-6"></x-frontend.single-ad>
                @empty
                    <x-not-found2 message="Sorry ! No ads found"/>
                @endforelse
            </div>
            <div class="page-navigation">
                {{ $adlistings->links() }}
            </div>
        </div>
    </section>
@endsection
