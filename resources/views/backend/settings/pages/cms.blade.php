@extends('backend.settings.setting-layout')
@section('title') {{ __('cms_setting') }} @endsection

@section('cms-setting')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills mb-3" id="cms-pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="pill" href="#cms-home" role="tab"
                    aria-controls="home" aria-selected="false">{{ __('home') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="about-tab" data-toggle="pill" href="#cms-about" role="tab"
                    aria-controls="about" aria-selected="false">{{ __('about') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="terms-tab" data-toggle="pill" href="#cms-terms" role="tab"
                    aria-controls="terms" aria-selected="false">{{ __('terms_condition') }}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="privacy-tab" data-toggle="pill" href="#cms-privacy" role="tab"
                    aria-controls="privacy" aria-selected="false">{{ __('privacy_policy') }}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="posting-tab" data-toggle="pill" href="#cms-posting" role="tab"
                    aria-controls="posting" aria-selected="false">{{ __('posting_rules') }}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="membership-tab" data-toggle="pill" href="#cms-membership" role="tab"
                    aria-controls="membership" aria-selected="false">{{ __('membership') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="price-plan-tab" data-toggle="pill" href="#cms-price-plan" role="tab"
                    aria-controls="price-plan" aria-selected="false">{{ __('price_plan') }}</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link " id="blog-tab" data-toggle="pill" href="#cms-blog" role="tab"
                    aria-controls="blog" aria-selected="false">{{ __('blog') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="ads-tab" data-toggle="pill" href="#cms-ads" role="tab"
                    aria-controls="ads" aria-selected="false">{{ __('ads') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="contact-tab" data-toggle="pill" href="#cms-contact" role="tab"
                    aria-controls="contact" aria-selected="false">{{ __('contact') }}</a>
            </li>


            <li class="nav-item" role="presentation">
                <a class="nav-link " id="faq-tab" data-toggle="pill" href="#cms-faq" role="tab"
                    aria-controls="faq" aria-selected="false">{{ __('faqs') }}</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link " id="dashboard-tab" data-toggle="pill" href="#cms-dashboards" role="tab"
                    aria-controls="dashboard" aria-selected="false">{{ __('dashboards') }}</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="cms-pills-tabContent">
            {{-- About Settings --}}
            <div class="tab-pane fade show active" id="cms-home" role="tabpanel" aria-labelledby="home-tab">
                <x-backend.setting.cms.home-setting :cms="$cms"  />
            </div>
            <div class="tab-pane fade " id="cms-about" role="tabpanel" aria-labelledby="about-tab">
                <x-backend.setting.cms.about-setting :aboutcontent="$cms->about_body" :aboutVideoThumb="$cms->about_video_thumb_path" :aboutBackground="$cms->about_background_path" />
            </div>

            {{-- Terms Settings --}}
            <div class="tab-pane fade" id="cms-terms" role="tabpanel" aria-labelledby="terms-tab">
                <x-backend.setting.cms.terms-condition-setting :terms="$cms->terms_body" :termsBackground="$cms->terms_background_path"/>
            </div>

            {{-- Posting Rules Settings --}}
            <div class="tab-pane fade" id="cms-privacy" role="tabpanel" aria-labelledby="posting-tab">
                <x-backend.setting.cms.privacy-policy-setting :privacy="$cms->privacy_body" :privacyBackground="$cms->privacy_background_path"/>
            </div>

            {{-- Posting Rules Settings --}}
            <div class="tab-pane fade" id="cms-posting" role="tabpanel" aria-labelledby="posting-tab">
                <x-backend.setting.cms.posting-rules-setting :rules="$cms->posting_rules_body" :postingRulesBackground="$cms->posting_rules_background_path"/>
            </div>

            {{-- Membership --}}
            <div class="tab-pane fade" id="cms-membership" role="tabpanel" aria-labelledby="membership-tab">
                <x-backend.setting.cms.membership :cms="$cms" />
            </div>
            {{-- Pricing Plan --}}
            <div class="tab-pane fade" id="cms-price-plan" role="tabpanel" aria-labelledby="price-plan-tab">
                <x-backend.setting.cms.pricing-plan  :cms="$cms" />
            </div>
            {{-- Blog --}}
            <div class="tab-pane fade" id="cms-blog" role="tabpanel" aria-labelledby="blog-tab">
                <x-backend.setting.cms.blog  :cms="$cms" />
            </div>
            {{-- Ads --}}
            <div class="tab-pane fade" id="cms-ads" role="tabpanel" aria-labelledby="ads-tab">
                <x-backend.setting.cms.ads  :cms="$cms" />
            </div>
            {{-- Contact --}}
            <div class="tab-pane fade" id="cms-contact" role="tabpanel" aria-labelledby="contact-tab">
                <x-backend.setting.cms.contact  :cms="$cms" />
            </div>
            {{-- Faq --}}
            <div class="tab-pane fade" id="cms-faq" role="tabpanel" aria-labelledby="faqs-tab">
                <x-backend.setting.cms.faqs :cms="$cms" />
            </div>
            {{-- Faq --}}
            <div class="tab-pane fade" id="cms-dashboards" role="tabpanel" aria-labelledby="dashboards-tab">
                <x-backend.setting.cms.dashboards  :cms="$cms" />
            </div>
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
    ClassicEditor
        .create(document.querySelector('#about_ck'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#terms_ck'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#rules'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#privacy_ck'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
