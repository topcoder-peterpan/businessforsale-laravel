@extends('layouts.backend.admin')
@section('title') {{ __('ad_details') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('ad_details') }}</h3>
                        <a href="{{ route('module.ad.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>

                    <div class="row m-2">
                        <div class="col-md-4">
                            <h5><strong>{{ __('thumbnail') }}</strong></h5>
                            @if ($ad->thumbnail)
                                <img src="{{ asset($ad->thumbnail) }}" alt="image" class="image-fluid" height="350px"
                                width="350px">
                            @else
                                <img src="{{ asset('backend/image/thumbnail.jpg') }}" alt="image" class="image-fluid" height="350px"
                                width="350px">
                            @endif
                        </div>
                        <div class="col-md-8 pt-4">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('title') }}</th>
                                        <td width="80%">{{ $ad->title }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('customer') }}</th>
                                        <td width="80%">{{ $ad->customer->name }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('price') }}</th>
                                        <td width="80%">{{ $ad->price }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('category') }}</th>
                                        <td width="80%">{{ $ad->category->name }}</td>
                                    </tr>
                                    @if ($ad->subcategory->name)
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('subcategory') }}</th>
                                            <td width="80%">{{ $ad->subcategory->name }}</td>
                                        </tr>
                                    @endif
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('brand') }}</th>
                                        <td width="80%">{{ $ad->brand->name }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('location') }}</th>
                                        <td width="80%">{{ $ad->city->name }}, {{ $ad->town->name }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('model') }}</th>
                                        <td width="80%">{{ $ad->model }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('condition') }}</th>
                                        <td width="80%">{{ ucfirst($ad->condition) }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('authenticity') }}</th>
                                        <td width="80%">{{ ucfirst($ad->authenticity) }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('negotiable') }}</th>
                                        <td width="80%">{{ $ad->negotiable ? 'Yes':'No' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('featured') }}</th>
                                        <td width="80%">{{ $ad->featured ? 'Yes':'No' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('total_views') }}</th>
                                        <td width="80%">{{ $ad->total_views }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('ad_link') }}</th>
                                        <td width="80%"><a target="_blank"
                                                href="{{ route('frontend.addetails', $ad->slug) }}">{{ __('go_to_link') }}</a></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('description') }}</th>
                                        <td width="80%">{!! $ad->description !!}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('features') }}</th>
                                        <td width="80%">
                                            <ul>
                                                @forelse ($ad->adFeatures as $feature)
                                                    <li>{{ $feature->name }}</li>
                                                @empty
                                                No features found
                                                {{ __('no_features_found') }}
                                                @endforelse
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('galleries') }}</th>
                                        <td width="80%">
                                            @foreach ($ad->galleries as $gallery)
                                                <img width="50px" height="50px" src="{{ asset($gallery->image) }}" alt="">
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

        .ck-editor__editable_inline {
            min-height: 170px;
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('.select2s4').select2({
            theme: 'bootstrap4'
        })
        $('.select2ds4').select2({
            theme: 'bootstrap4'
        })
        $('.select2ds4').select2({
            theme: 'bootstrap4'
        })
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
