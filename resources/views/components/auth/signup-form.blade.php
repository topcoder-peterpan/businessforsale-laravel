<div class="col-lg-6 order-1 order-lg-0">
    <div class="registration-form">
        <h2 class="text-center text--heading-1 registration-form__title">{{ __('website.sign_up') }}</h2>
       {{-- Social Login --}}
       <x-auth.social-login/>

       <h2 class="registration-form__alternative-title text--body-3">or Sign up With Email</h2>
        <div class="registration-form__wrapper">
            <form action="{{ route('customer.register') }}" method="POST">
                @csrf
                <div class="input-field">
                    <input value="{{ old('name') }}" type="text" placeholder="Full Name" name="name" class="@error('name') is-invalid border-danger @enderror" required />
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="input-field">
                    <input value="{{ old('username') }}" type="text" placeholder="Username" name="username" class="@error('username') is-invalid border-danger @enderror" required />
                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="input-field">
                    <input value="{{ old('email') }}" type="email" placeholder="Email address" name="email" class="@error('email') is-invalid border-danger @enderror" required />
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="input-field">
                    <input type="password" name="password" placeholder="Password" id="password" class="@error('password') is-invalid border-danger @enderror" />
                    <span class="icon icon--eye" onclick="showPassword('password',this)">
                        <x-svg.eye-icon />
                    </span>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="input-field">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" id="cpassword" class="@error('password') is-invalid border-danger @enderror" required />
                    <span class="icon icon--eye" onclick="showPassword('cpassword',this)">
                        <x-svg.eye-icon />
                    </span>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="registration-form__option">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkme" required />
                        <label class="form-check-label" for="checkme">
                            {{ __('website.read_agree') }} <a href="{{ route('frontend.privacy') }}">{{ __('website.privacy_policy') }}</a> {{ __('website.and') }}
                            <a href="{{ route('frontend.terms') }}">
                                {{ __('website.terms_conditions') }}
                            </a>
                        </label>
                    </div>
                </div>
                <button class="btn btn--lg w-100 registration-form__btns" type="submit">
                    {{ __('website.sign_up') }}
                    <span class="icon--right">
                        <x-svg.right-arrow-icon stroke="#fff" />
                    </span>
                </button>
                <p class="text--body-3 registration-form__redirect">{{ __('website.have_account') }} ? <a href="{{ route('customer.login') }}">{{ __('website.sign_in') }}</a></p>
            </form>
        </div>
    </div>
</div>

