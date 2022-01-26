@extends('layouts.frontend.layout_one')

@section('title', __('website.account_setting'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_account_setting_background_path">
        {{ __('website.overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}" class="breedcrumb__page-link text--body-3">{{ __('website.dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.settings') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="dashboard-setting">
                        <!-- Account Information -->
                        <div class="dashboard-setting__box account-information">
                            <h2 class="text--body-2-600">{{ __('website.account_information') }}</h2>
                            <form action="{{ route('frontend.profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="user-info">
                                    <div class="img">
                                        <div class="img-wrapper">
                                            <img src="{{ asset($user->image) }}" alt="user-img" id="image">
                                        </div>
                                        <input name="image"
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                id="hiddenImgInput" type="file" hidden />
                                        <button onclick="$('#hiddenImgInput').click()" class="btn btn--bg"
                                            type="button">{{ __('website.choose_image') }}</button>
                                    </div>
                                </div>
                                <div class="input-field__group">
                                    <div class="input-field">
                                        <label for="Fname">{{ __('website.full_name') }}</label>
                                        <input required name="name" value="{{ $user->name }}" type="text" placeholder="Full name" id="Fname" class="@error('name') is-invalid border-danger @enderror" required>
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="input-field">
                                        <label for="telephonee">{{ __('website.phone_number') }}</label>
                                        <input name="phone" value="{{ $user->phone ? $user->phone : '' }}" type="tel" id="telephonee" placeholder="Phone" class="@error('phone') is-invalid border-danger @enderror">
                                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="input-field__group">
                                    <div class="input-field">
                                        <label for="email">Email</label>
                                        <input required name="email" value="{{ $user->email }}" type="email" placeholder="Email Address" id="email" class="@error('email') is-invalid border-danger @enderror" required >
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="input-field">
                                        <label for="web">{{ __('website.website_links') }} <span>({{ __('website.optional') }})</span></label>
                                        <input name="web" value="{{ $user->web ? $user->web : '' }}" type="text" placeholder="website url" id="web" class="@error('web') is-invalid border-danger @enderror">
                                        @error('web')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <button class="btn" type="submit">{{ __('website.save_changes') }}</button>
                            </form>
                        </div>
                        <!-- change Password -->
                        <div class="dashboard-setting__box change-password">
                            <h2 class="text--body-2-600">{{ __('website.change_password') }}</h2>
                            <form action="{{ route('frontend.password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-field__group">
                                    <div class="input-field">
                                        <label for="cpassword">{{ __('website.current_password') }}</label>
                                        <input required name="current_password" type="password" placeholder="Password" id="cpassword" class="@error('current_password') is-invalid border-danger @enderror" >
                                        @error('current_password')<span style="font-size: 12px" class="text-danger">{{ $message }}</span>@enderror
                                        <span class="icon icon--eye" onclick="showPassword('cpassword',this)"
                                            @error('current_password')
                                                style="top: 50%;"
                                            @enderror
                                        >
                                            <x-svg.eye-icon />
                                        </span>
                                    </div>
                                    <div class="input-field">
                                        <label for="npassword">{{ __('website.new_password') }}</label>
                                        <input required name="password" type="password" placeholder="Password" id="npassword" class="@error('password') is-invalid border-danger @enderror">
                                        @error('password')<span style="font-size: 12px" class="text-danger">{{ $message }}</span>@enderror

                                        <span class="icon icon--eye" onclick="showPassword('npassword',this)"
                                            @error('password')
                                                style="top: 50%;"
                                            @enderror
                                        >
                                            <x-svg.eye-icon />
                                        </span>
                                    </div>
                                    <div class="input-field">
                                        <label for="confirmpass">{{ __('website.confirm_password') }}</label>
                                        <input required name="password_confirmation" type="password" placeholder="Password" id="confirmpass" class="@error('password_confirmation') is-invalid border-danger @enderror">
                                        @error('password_confirmation')<span style="font-size: 12px" class="text-danger">{{ $message }}</span>@enderror

                                        <span class="icon icon--eye" onclick="showPassword('confirmpass',this)"
                                            @error('password_confirmation')
                                                style="top: 50%;"
                                            @enderror
                                        >
                                            <x-svg.eye-icon />
                                        </span>
                                    </div>
                                </div>
                                <button class="btn" type="submit">
                                    {{ __('website.save_changes') }}
                                </button>
                            </form>
                        </div>
                        <!-- Delete Account -->
                        <div class="dashboard-setting__box delete-account">
                            <h2 class="text--body-2-600">{{ __('website.delete_account') }}</h2>
                            <p class="delete-account__details text--body-3">
                                {{ __('website.delete_account_alert') }}
                            </p>
                            <form action="{{ route('frontend.account.delete', auth()->id()) }}" method="POST" onclick="return confirm('Are you sure?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn">
                                    <span class="icon--left">
                                        <x-svg.delete-icon />
                                    </span>
                                    {{ __('website.delete_account') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection

{{-- @section('frontend_style')
    <style>
        .input-field .icon{
            top: 50% !important;
        }
    </style>
@endsection --}}

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/passwordType.js"></script>
@endsection
