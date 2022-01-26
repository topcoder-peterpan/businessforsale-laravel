@extends('backend.settings.setting-layout')
@section('title') {{ __('website_setting') }} @endsection

@section('layout')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('layout_setting') }}</h3>
        </div>
        <div class="row pt-3 pb-4">
            <form action="{{ route('setting', 'layout') }}" method="post" id="layout_form">
                @csrf
                @method('PUT')
                <input type="hidden" name="default_layout" id="layout_mode">
            </form>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('left_navigation_layout') }}</h5>
                    </div>
                    <img height="300px" width="600px" src="{{ asset('backend/image/setting/left-nav.png') }}"
                        class="card-img-top" alt="top nav">

                    @if (userCan('setting.update'))
                    <div class="card-body">
                        @if ($settings->default_layout)
                            <a href="javascript:void(0)" onclick="layoutChange(0)" class="btn btn-danger">{{ __('deactivate') }}</a>
                        @else
                            <a href="javascript:void(0)" onclick="layoutChange(1)" class="btn btn-primary">{{ __('activate') }}</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('top_navigation_layout') }}</h5>
                    </div>
                    <img height="300px" width="600px" src="{{ asset('backend/image/setting/top-nav.png') }}"
                        class="card-img-top" alt="top nav">
                    @if (userCan('setting.update'))
                    <div class="card-body">
                        @if ($settings->default_layout)
                            <a href="javascript:void(0)" onclick="layoutChange(0)" class="btn btn-primary">{{ __('activate') }}</a>
                        @else
                            <a href="javascript:void(0)" onclick="layoutChange(1)" class="btn btn-danger">{{ __('deactivate') }}</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        function layoutChange(value) {
            $('#layout_mode').val(value)
            $('#layout_form').submit()
        }
    </script>
@endsection
