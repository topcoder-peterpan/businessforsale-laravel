@extends('layouts.backend.admin')
@section('title') {{ __('create_plan') }} @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create_plan') }}</h3>
                        <a href="{{ route('module.plan.index') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('module.plan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="label">{{ __('label') }} <small class="text-danger">*</small></label>
                                        <input required type="text" id="label" name="label" value="{{ old('label') }}" class="form-control @error('label') is-invalid @enderror" placeholder="Basic / Standard / Premium">
                                        @error('label') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="ad_limit">{{ __('ad_limit') }} <small class="text-danger">*</small> <small>({{ __('post_ad_limit') }})</small></label>
                                        <input required type="number" id="ad_limit" name="ad_limit" value="{{ old('ad_limit') }}" class="form-control @error('ad_limit') is-invalid @enderror">
                                        @error('ad_limit') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="price">{{ __('price') }} <small class="text-danger">*</small></label>
                                        <input required type="number" id="price" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror">
                                        @error('price') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="featured_limit">
                                            {{ __('featured_limit') }}<small class="text-danger">*</small> <small>({{ __('featured_ad_on_home_page') }})</small>
                                        </label>
                                        <input required type="number" id="featured_limit" name="featured_limit" value="{{ old('featured_limit') }}" class="form-control @error('featured_limit') is-invalid @enderror">
                                        @error('featured_limit') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="badge">{{ __('badge') }}</label>
                                        <select name="badge" id="badge" class="form-control @error('badge') is-invalid @enderror">
                                            <option value="1">{{ __('yes') }}</option>
                                            <option value="0">{{ __('no') }}</option>
                                        </select>
                                        @error('badge') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="multiple_image">{{ __('multiple_image') }}</label>
                                        <select name="multiple_image" id="multiple_image" class="form-control @error('multiple_image') is-invalid @enderror">
                                            <option value="1">{{ __('yes') }}</option>
                                            <option value="0">{{ __('no') }}</option>
                                        </select>
                                        @error('multiple_image') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="customer_support">{{ __('customer_support') }}</label>
                                        <select id="customer_support" name="customer_support" class="form-control @error('customer_support') is-invalid @enderror">
                                            <option value="1">{{ __('yes') }}</option>
                                            <option value="0">{{ __('no') }}</option>
                                        </select>
                                        @error('customer_support') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-success btn-lg" type="submit"><i class="fas fa-plus"></i>&nbsp; {{ __('add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
