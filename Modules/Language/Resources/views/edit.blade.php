@extends('layouts.backend.admin')
@section('title') {{ __('edit_language') }} @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_language') }}</h3>
                        <a href="{{ route('language.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('language.update', $language->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('language_name') }}<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <select name="name" class="select2bs4 w-100 @error('name') is-invalid @enderror">
                                            @foreach ($translations as $key => $country)
                                                <option {{ $country['name'] == $language->name ? 'selected': '' }} value="{{ $country['name'] }}"> {{ $country['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('name') <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('language_code') }}<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <select name="code" class="select2bs4 w-100 @error('code') is-invalid @enderror">
                                            @foreach ($translations as $key => $country)
                                                <option {{ $key == $language->code ? 'selected': '' }} value="{{ $key }}"> {{ $key }}</option>
                                            @endforeach
                                        </select>
                                        @error('code') <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i>&nbsp; {{ __('update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
