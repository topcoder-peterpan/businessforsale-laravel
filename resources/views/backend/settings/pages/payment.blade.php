@extends('backend.settings.setting-layout')
@section('title') {{ __('website_setting') }} @endsection

@section('payment-setting')
<div class="row">
        {{-- Paypal Setting  --}}
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="line-height: 36px;">{{ __('paypal_settings') }}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('admin.paypalsetting') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('livemode') }}</label>
                            <div class="col-sm-9">
                                <input {{ $paymentsetting->paypal_live_mode ? 'checked':'' }} type="checkbox" name="paypal_live_mode"
                                    data-bootstrap-switch value="1">
                            </div>
                        </div>
                        @if ($paymentsetting->paypal_live_mode)
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                            <div class="col-sm-9">
                                <input value="{{ env("PAYPAL_LIVE_CLIENT_ID") }}" name="paypal_client_id" type="text"
                                    class="form-control @error('paypal_client_id') is-invalid @enderror" autocomplete="off">
                                @error('paypal_client_id') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                            <div class="col-sm-9">
                                <input value="{{ env('PAYPAL_LIVE_CLIENT_SECRET') }}" name="paypal_client_secret" type="text"
                                    class="form-control @error('paypal_client_secret') is-invalid @enderror"
                                    autocomplete="off">
                                @error('paypal_client_secret') <span class="invalid-feedback"
                                    role="alert"><span>{{ $message }}</span></span> @enderror
                            </div>
                        </div>
                        @else
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                            <div class="col-sm-9">
                                <input value="{{ env("PAYPAL_SANDBOX_CLIENT_ID") }}" name="paypal_client_id" type="text"
                                    class="form-control @error('paypal_client_id') is-invalid @enderror" autocomplete="off">
                                @error('paypal_client_id') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                            <div class="col-sm-9">
                                <input value="{{ env('PAYPAL_SANDBOX_CLIENT_SECRET') }}" name="paypal_client_secret" type="text"
                                    class="form-control @error('paypal_client_secret') is-invalid @enderror"
                                    autocomplete="off">
                                @error('paypal_client_secret') <span class="invalid-feedback"
                                    role="alert"><span>{{ $message }}</span></span> @enderror
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                            <div class="col-sm-9">
                                <input {{ $paymentsetting->paypal ? 'checked':'' }} type="checkbox" name="paypal"
                                    data-bootstrap-switch value="1">
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

    {{-- Stripe Setting  --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('stripe_settings') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.stripesetting') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('secret_key') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("STRIPE_KEY") }}" name="stripe_client_id" type="text"
                                class="form-control @error('stripe_client_id') is-invalid @enderror" autocomplete="off">
                            @error('stripe_client_id') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('publisher_key') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('STRIPE_SECRET') }}" name="stripe_client_secret" type="text"
                                class="form-control @error('stripe_client_secret') is-invalid @enderror" autocomplete="off">
                            @error('stripe_client_secret') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input {{ $paymentsetting->stripe ? 'checked':'' }} type="checkbox" name="stripe"
                                data-bootstrap-switch value="1">
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

    {{-- Razorpay Setting  --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('razorpay_settings') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.razorpaysetting') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('secret_key') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("RAZORPAY_KEY") }}" name="razorpay_client_id" type="text"
                                class="form-control @error('razorpay_client_id') is-invalid @enderror" autocomplete="off">
                            @error('razorpay_client_id') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('publisher_key') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('RAZORPAY_SECRET') }}" name="razorpay_client_secret" type="text"
                                class="form-control @error('razorpay_client_secret') is-invalid @enderror" autocomplete="off">
                            @error('razorpay_client_secret') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input {{ $paymentsetting->razorpay ? 'checked':'' }} type="checkbox" name="razorpay"
                                data-bootstrap-switch value="1">
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

    {{-- SSL Commerz Setting  --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('sslcommerz_settings') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.sslcommerzsetting') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('store_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("STORE_ID") }}" name="ssl_client_id" type="text"
                                class="form-control @error('ssl_client_id') is-invalid @enderror" autocomplete="off">
                            @error('ssl_client_id') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('store_password') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('STORE_PASSWORD') }}" name="ssl_client_secret" type="text"
                                class="form-control @error('ssl_client_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('ssl_client_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input {{ $paymentsetting->ssl_commerz ? 'checked':'' }} type="checkbox" name="ssl_commerz"
                                data-bootstrap-switch value="1">
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

    {{-- Paystack Setting  --}}
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('paystack_settings') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.paystacksetting') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_id') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env("PAYSTACK_PUBLIC_KEY") }}" name="paystack_client_id" type="text"
                                class="form-control @error('paystack_client_id') is-invalid @enderror" autocomplete="off">
                            @error('paystack_client_id') <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('client_secret') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('PAYSTACK_SECRET_KEY') }}" name="paystack_client_secret" type="text"
                                class="form-control @error('paystack_client_secret') is-invalid @enderror"
                                autocomplete="off">
                            @error('paystack_client_secret') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('merchant_email') }}</label>
                        <div class="col-sm-9">
                            <input value="{{ env('MERCHANT_EMAIL') }}" name="merchant_email" type="text"
                                class="form-control @error('merchant_email') is-invalid @enderror"
                                autocomplete="off">
                            @error('merchant_email') <span class="invalid-feedback"
                                role="alert"><span>{{ $message }}</span></span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{ __('status') }}</label>
                        <div class="col-sm-9">
                            <input {{ $paymentsetting->paystack ? 'checked':'' }} type="checkbox" name="paystack"
                                data-bootstrap-switch value="1">
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
    });
</script>
@endsection
