@extends('backend.settings.setting-layout')
@section('title') {{ __('website_setting') }} @endsection

@section('website-settings')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ session('website_setting_section') == 'basic' ? 'active':''  }}" id="basic-tab" data-toggle="pill" href="#basic" role="tab"
                    aria-controls="basic" aria-selected="true">{{ __('basic') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ session('website_setting_section') == 'social_links' ? 'active':''  }}" id="basic-tab" data-toggle="pill" href="#social_media_links" role="tab"
                    aria-controls="basic" aria-selected="true">{{ __('social_media_links') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ session('website_setting_section') == 'logo' ? 'active':''  }}" id="basic-tab" data-toggle="pill" href="#logo" role="tab" aria-controls="basic"
                    aria-selected="true">{{ __('logo') }}</a>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="about-tab" data-toggle="pill" href="#about" role="tab" aria-controls="about"
                    aria-selected="false">{{ __('about') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="terms-tab" data-toggle="pill" href="#terms" role="tab" aria-controls="terms"
                    aria-selected="false">{{ __('terms_condition') }}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="posting-tab" data-toggle="pill" href="#posting" role="tab"
                    aria-controls="posting" aria-selected="false">{{ __('posting_rules') }}
                </a>
            </li>  --}}
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            {{-- Basic Settings --}}
            <div class="tab-pane fade {{ session('website_setting_section') == 'basic' ? 'show active':''  }}" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                <x-backend.setting.website.basic-setting :setting="$setting" />
            </div>

            {{-- Social Media Links Settings --}}
            <div class="tab-pane fade {{ session('website_setting_section') == 'social_links' ? 'show active':''  }}" id="social_media_links" role="tabpanel" aria-labelledby="basic-tab">
                <form class="form-horizontal" action="{{ route('setting', 'website') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input name="section" type="text" value="social_links" hidden>
                    <div class="row ">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('facebook') }}</label>
                                <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                    name="facebook" placeholder="{{ __('enter_company_facebook_link') }}"
                                    value="{{ $setting->facebook }}">
                                @error('facebook') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('twitter') }}</label>
                                <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                    name="twitter" placeholder="{{ __('enter_company_twitter_link') }}"
                                    value="{{ $setting->twitter }}">
                                @error('twitter') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('instagram') }}</label>
                                <input type="url" class="form-control @error('instagram') is-invalid @enderror"
                                    name="instagram" placeholder="{{ __('enter_company_instagram_link') }}"
                                    value="{{ $setting->instagram }}">
                                @error('instagram') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('youtube') }}</label>
                                <input type="url" class="form-control @error('youtube') is-invalid @enderror"
                                    name="youtube" placeholder="{{ __('enter_company_youtube_link') }}"
                                    value="{{ $setting->youtube }}">
                                @error('youtube') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('linkedin') }}</label>
                                <input type="url" class="form-control @error('linkdin') is-invalid @enderror"
                                    name="linkdin" placeholder="{{ __('enter_company_linkdin_link') }}"
                                    value="{{ $setting->linkdin }}">
                                @error('linkdin') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('whatsapp') }}</label>
                                <input type="url" class="form-control @error('whatsapp') is-invalid @enderror"
                                    name="whatsapp" placeholder="{{ __('enter_company_whatsapp_link') }}"
                                    value="{{ $setting->whatsapp }}">
                                @error('whatsapp') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 offset-3 text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i> {{ __('update_settings') }}
                            </button>
                        </div>
                    </div>
                </form >
            </div>

            {{-- Logo Settings --}}
            <div class="tab-pane fade {{ session('website_setting_section') == 'logo' ? 'show active':''  }}" id="logo" role="tabpanel" aria-labelledby="basic-tab">
                {{-- <x-backend.setting.website.basic-setting :setting="$setting"/> --}}
                <form class="form-horizontal" action="{{ route('setting', 'website') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input name="section" type="text" value="logo" hidden>
                    <div class="row justify-content-between">
                        <div class="col-3">
                            <div class="form-group">
                                <label>{{ __('theme_logo') }} <small>({{ __('white_background') }})</small></label>
                                <div class="row">
                                    @if (file_exists($setting->logo_image))
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset($setting->logo_image) }}" name="logo_image"
                                        autocomplete="image">
                                    @else
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset('backend/image/logo-default.png') }}"
                                        name="favicon_image">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mx-2">
                            <div class="form-group">
                                <label>{{ __('theme_logo') }} <small>({{ __('dark_background') }})</small></label>
                                <div class="row">
                                    @if (file_exists($setting->logo_image2))
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset($setting->logo_image2) }}" name="logo_image2"
                                        autocomplete="image">
                                    @else
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset('backend/image/logo-default.png') }}"
                                        name="favicon_image">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-3 ">
                            <div class="form-group">
                                <label>{{ __('site_favicon') }}</label>
                                <div class="row">
                                    @if (file_exists($setting->favicon_image))
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset($setting->favicon_image) }}" name="favicon_image">
                                    @else
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset('backend/image/logo-default.png') }}"
                                        name="favicon_image">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 offset-3 text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i> {{ __('update_settings') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- About Settings --}}
            {{-- <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                <x-backend.setting.website.about-setting :aboutcontent="$setting->about" />
            </div> --}}

            {{-- Terms Settings --}}
            {{-- <div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                <x-backend.setting.website.terms-condition-setting :terms="$setting->terms" />
            </div> --}}

            {{-- Posting Rules Settings --}}
            {{-- <div class="tab-pane fade" id="posting" role="tabpanel" aria-labelledby="posting-tab">
                <x-backend.setting.website.posting-rules-setting :rules="$setting->posting_rules" />
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
<style>
    .ck-editor__editable_inline {
        min-height: 170px;
    }
</style>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
<script>
    $('.dropify').dropify();
    // ClassicEditor
    //     .create(document.querySelector('#about_ck'))
    //     .catch(error => {
    //         console.error(error);
    //     });

    // ClassicEditor
    //     .create(document.querySelector('#terms_ck'))
    //     .catch(error => {
    //         console.error(error);
    //     });

    // ClassicEditor
    //     .create(document.querySelector('#rules'))
    //     .catch(error => {
    //         console.error(error);
    //     });
</script>
@endsection
