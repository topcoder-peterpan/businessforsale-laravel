<form class="form-horizontal" action="{{ route('setting', 'website') }}" method="POST"
enctype="multipart/form-data">
@method('PUT')
@csrf
<input name="section" type="text" value="basic" hidden>
<div class="row ">
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('site_name') }}</label>
            <input value="{{ $setting->name }}" name="name" type="text"
                class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('enter_site_name') }}">
            @error('name') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('phone') }}</label>
            <input value="{{ $setting->phone }}" name="phone" type="text"
                class="form-control @error('phone') is-invalid @enderror" placeholder="{{ __('enter_site_phone') }}">
            @error('phone') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('address') }}</label>
            <textarea value="{{ $setting->address }}" name="address"
                class="form-control @error('address') is-invalid @enderror"
                placeholder="{{ __('enter_site_address') }}">{{ $setting->address }}</textarea>
            @error('address') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('map_address') }}</label>
            <textarea value="{{ $setting->map_address }}" name="map_address"
                class="form-control @error('map_address') is-invalid @enderror"
                placeholder="{{ __('enter_iframe_link') }}">{{ $setting->map_address }}</textarea>
            @error('map_address') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('site_email') }}</label>
            <input value="{{ $setting->email }}" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('enter_site_email') }}">
            @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('support_email') }}</label>
            <input value="{{ $setting->support_email }}" name="support_email" type="support_email"
                class="form-control @error('support_email') is-invalid @enderror"
                placeholder="{{ __('enter_support_email') }}">
            @error('support_email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('android_app_link') }}</label>
            <input type="url" class="form-control @error('android') is-invalid @enderror" name="android"
                placeholder="{{ __('enter_company_android_link') }}" value="{{ $setting->android }}">
            @error('android') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('ios_app_link') }}</label>
            <input type="url" class="form-control @error('ios') is-invalid @enderror" name="ios"
                placeholder="{{ __('ios') }}" value="{{ $setting->ios }}">
            @error('ios') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('free_ad_limit') }}</label>
            <input type="number" class="form-control @error('free_ad_limit') is-invalid @enderror" name="free_ad_limit"
                placeholder="{{ __('enter_ad_limit') }}" value="{{ $setting->free_ad_limit }}">
            @error('free_ad_limit') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('free_ad_featured_limit') }}</label>
            <input type="number" class="form-control @error('free_featured_ad_limit') is-invalid @enderror" name="free_featured_ad_limit"
                placeholder="{{ __('enter_featured_ad_limit') }}" value="{{ $setting->free_featured_ad_limit }}">
            @error('free_featured_ad_limit') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
</div>
@if (userCan('setting.update'))
    <div class="row mt-3">
        <div class="col-6 offset-3 text-center">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_settings') }}
            </button>
        </div>
    </div>
@endif

</form>
