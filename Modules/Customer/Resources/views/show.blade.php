@extends('layouts.backend.admin')
@section('title') {{ __('customer_details') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('customer_details') }}</h3>
                        <a href="{{ route('module.customer.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>

                    <div class="row m-2">
                        <div class="col-md-4">
                            <h5><strong>{{ __('thumbnail') }}</strong></h5>
                            @if ($customer->image)
                                <img src="{{ asset($customer->image) }}" alt="image" class="image-fluid" height="350px"
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
                                        <th width="20%">{{ __('name') }}</th>
                                        <td width="80%">{{ $customer->name }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('email') }}</th>
                                        <td width="80%">{{ $customer->email }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('username') }}</th>
                                        <td width="80%">{{ $customer->username }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('phone') }}</th>
                                        <td width="80%">{{ $customer->phone }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('website') }}</th>
                                        <td width="80%">{{ $customer->website }}</td>
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

