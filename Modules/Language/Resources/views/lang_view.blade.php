@extends('layouts.backend.admin')

@section('title') {{ __('translate_language') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('backend_keywords') }}</h3>
                        <a href="{{ route('language.create') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('translation.update') }}" method="POST" >
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    @csrf
                                    <input type="hidden" name="lang_id" value="{{ $language->id }}">
                                    @foreach ($translations as $key => $value)
                                        <div class="col-3">
                                            <div class="card">
                                                <div class="card-header">{{ $key }}</div>
                                                <div class="card-body">
                                                    <p>
                                                        <input type="text" class="form-control" name="{{ $key }}" value="{{ $value }}">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="d-flex mx-auto">
                                        <button type="submit" class="lang-btn btn btn-success"><i
                                            class="fas fa-sync"></i>&nbsp; {{ __('update') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .lang-btn {
            position: fixed;
            left: 50%;
            bottom: 50px;
            width: 200px;
            padding: 15px;
            text-align: center;
            transform: translateX(-50%,0);
        }
    </style>
@endsection
