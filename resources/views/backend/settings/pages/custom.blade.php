@extends('backend.settings.setting-layout')
@section('title') {{ __('website_setting') }} @endsection

@section('custom-setting')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('custom_css_js') }}</h3>
        </div>
        <div class="row pt-3 pb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('setting', 'custom') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="role_name">{{ __('header_custom_style') }} ({{ __('before_head_end') }}) </label>
                                <textarea name="header_css" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->header_css }}</textarea>
                                @error('name')<span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>@enderror
                                <span>{{ __('write_style_with_style_tag') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="role_name">{{ __('header_custom_script') }} ({{ __('before_head_end') }}) </label>
                                <textarea name="header_script" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->header_script }}</textarea>
                                @error('name')<span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>@enderror
                                <span>{{ __('write_script_with_script_tag') }}</span>

                            </div>
                            <div class="form-group">
                                <label for="role_name">{{ __('footer_custom_script') }} ({{ __('before_body_end') }}) </label>
                                <textarea name="body_script" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->body_script }}</textarea>
                                @error('name')<span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>@enderror
                                <span>{{ __('write_script_with_script_tag') }}</span>
                            </div>
                            @if (userCan('setting.update'))
                            <div class="form-group">
                                <button class="btn btn-primary">{{ __('update') }}</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
