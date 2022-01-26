@extends('backend.settings.setting-layout')
@section('title') {{ __('website_setting') }} @endsection

@section('seo-setting')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('seo_settings') }}</h3>
        </div>
        <div class="row pt-3 pb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.seo.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="seo_meta_title">{{ __('seo_meta_title') }}</label>
                                <input id="seo_meta_title" name="seo_meta_title" class="form-control @error('seo_meta_title') is-invalid @enderror" value="{{ $setting->seo_meta_title }}" />
                                @error('seo_meta_title')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="seo_meta_description">{{ __('seo_meta_description') }}</label>
                                <textarea id="seo_meta_description" name="seo_meta_description" class="form-control @error('seo_meta_description') is-invalid @enderror" rows="3">{{ $setting->seo_meta_description }}</textarea>
                                @error('seo_meta_description')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="seo_meta_keywords">{{ __('seo_meta_keywords') }}</label>
                                <textarea id="seo_meta_keywords" name="seo_meta_keywords" class="form-control @error('seo_meta_keywords') is-invalid @enderror" rows="3">{{ $setting->seo_meta_keywords }}</textarea>
                                @error('seo_meta_keywords')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            @if (userCan('setting.update'))
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i> {{ __('update') }}</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
