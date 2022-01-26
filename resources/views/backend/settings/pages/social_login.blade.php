@extends('backend.settings.setting-layout')
@section('title') {{ __('website_setting') }} @endsection

@section('social-login-setting')
<div class="row">
    {{-- Google Login Credential Setting --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('google_login_credential') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.socialsetting.update','google') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("GOOGLE_CLIENT_ID") }}" name="google_id" type="text"
                                class="form-control @error('google_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('google_id') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('GOOGLE_CLIENT_SECRET') }}" name="google_secret" type="text"
                                class="form-control @error('google_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('google_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input type="checkbox" name="google" {{ $socialsetting->google ? 'checked':'' }}  data-bootstrap-switch value="1">
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>


    {{-- Linkedin Login Credential Setting --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('linkedin_login_credential') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.socialsetting.update','linkedin') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("LINKEDIN_CLIENT_ID") }}" name="linkedin_id" type="text"
                                class="form-control @error('linkedin_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('linkedin_id') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('LINKEDIN_CLIENT_SECRET') }}" name="linkedin_secret" type="text"
                                class="form-control @error('linkedin_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('linkedin_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input type="checkbox" {{ $socialsetting->linkedin ? 'checked':'' }} name="linkedin" data-bootstrap-switch value="1">
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Facebook Login Credential Setting --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('facebook_login_credential') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.socialsetting.update','facebook') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("FACEBOOK_CLIENT_ID") }}" name="facebook_id" type="text"
                                class="form-control @error('facebook_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('facebook_id') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('FACEBOOK_CLIENT_SECRET') }}" name="facebook_secret" type="text"
                                class="form-control @error('facebook_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('facebook_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input type="checkbox" {{ $socialsetting->facebook ? 'checked':'' }} name="facebook" data-bootstrap-switch value="1">
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Twitter Login Credential Setting --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('twitter_login_credential') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.socialsetting.update','twitter') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("TWITTER_CLIENT_ID") }}" name="twitter_id" type="text"
                                class="form-control @error('twitter_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('twitter_id') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('TWITTER_CLIENT_SECRET') }}" name="twitter_secret" type="text"
                                class="form-control @error('twitter_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('twitter_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input type="checkbox" {{ $socialsetting->twitter ? 'checked':'' }} name="twitter" data-bootstrap-switch value="1">
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Github Login Credential Setting --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('github_login_credential') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.socialsetting.update','github') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("GITHUB_CLIENT_ID") }}" name="github_id" type="text"
                                class="form-control @error('github_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('github_id') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('GITHUB_CLIENT_SECRET') }}" name="github_secret" type="text"
                                class="form-control @error('github_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('github_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input type="checkbox" {{ $socialsetting->github ? 'checked':'' }} name="github" data-bootstrap-switch value="1">
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Gitlab Login Credential Setting --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('gitlab_login_credential') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.socialsetting.update','gitlab') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("GITLAB_CLIENT_ID") }}" name="gitlab_id" type="text"
                                class="form-control @error('gitlab_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('gitlab_id') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('GITLAB_CLIENT_SECRET') }}" name="gitlab_secret" type="text"
                                class="form-control @error('gitlab_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('gitlab_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input type="checkbox" {{ $socialsetting->gitlab ? 'checked':'' }} name="gitlab" data-bootstrap-switch value="1">
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Bitbucket Login Credential Setting --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('bitbucket_login_credential') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.socialsetting.update','bitbucket') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("BITBUCKET_CLIENT_ID") }}" name="bitbucket_id" type="text"
                                class="form-control @error('bitbucket_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('bitbucket_id') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('BITBUCKET_CLIENT_SECRET') }}" name="bitbucket_secret" type="text"
                                class="form-control @error('bitbucket_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('bitbucket_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input type="checkbox" name="bitbucket" {{ $socialsetting->bitbucket ? 'checked':'' }} data-bootstrap-switch value="1">
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
