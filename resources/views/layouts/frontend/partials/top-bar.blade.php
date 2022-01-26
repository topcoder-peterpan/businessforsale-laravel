<div class="alert alert-warning mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ __('website.upgrade_plan') }}!</strong> {{ __('website.limited_ads') }} <a href="{{ route('frontend.priceplan') }}" class="text-dark text-decoration-underline">{{ __('website.go_to_details') }}</a>
</div>

@section('frontend_style')
    <style>
        .header--one {
            top: 50px !important;
        }
        .header--fixed {
            top: 0 !important;
        }
    </style>
@endsection
