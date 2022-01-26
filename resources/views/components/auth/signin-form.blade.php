<div class="col-lg-6 order-1 order-lg-0">
    <div class="registration-form">
        <h2 class="text-center text--heading-1 registration-form__title">{{ __('website.sign_in') }}</h2>
       {{-- Social Login --}}
       <x-auth.social-login/>
        <div class="registration-form__wrapper">
            <form action="{{ route('frontend.login') }}" method="POST">
                @csrf
                <div class="input-field">
                    <input value="{{ old('email') }}" type="text" name="login_data" placeholder="Username or email address" class="@error('email') is-invalid border-danger @enderror @error('username') is-invalid border-danger @enderror" required />
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Password" id="password" name="password" class="@error('password') is-invalid border-danger @enderror" required />
                    <span class="icon icon--eye" onclick="showPassword('password',this)">
                        <x-svg.eye-icon />
                    </span>
                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="registration-form__option">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkme" />
                        <label class="form-check-label" for="checkme">{{ __('website.keep_me_logged') }}</label>
                    </div>

                    <div class="registration-form__forget-pass text--body-4">
                        <a href="{{ route('customer.forgot.password') }}">{{ __('website.forget_password') }}</a>
                    </div>
                </div>

                <button class="btn btn--lg w-100 registration-form__btns" type="submit">
                    {{ __('website.sign_in') }}
                    <span class="icon--right">
                        <x-svg.right-arrow-icon stroke="#fff" />
                    </span>
                </button>

                <p class="text--body-3 registration-form__redirect">{{ __('website.dont_have_account') }} ? <a href="{{ route('frontend.signup') }}">{{ __('website.sign_up') }}</a></p>
            </form>
        </div>
    </div>
</div>
