@extends('layouts.backend.admin')

@section('title')
{{ __('customer_list') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="line-height: 36px;">{{ __('customer_list') }}</h3>
                    <div class="col-md-6 col-sm-9  d-flex justify-content-between align-items-center  ml-auto">
                        <div class="col-md-6">
                            <select  class="form-control" id="customer_type_select">
                                <option value="all" {{ request('type') && request('type') != 'pro' ? 'selected' : '' }}>{{ __('all_customer') }}</option>
                                <option value="pro" {{ request('type') && request('type') == 'pro' ? 'selected' : '' }}>{{ __('pro_customer') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('module.customer.index')  }}" method="GET" id="customerSearchForm">
                                <input type="hidden" value="" name="type" id="customer_type">
                                <input type="text" class="form-control" value="{{ request('keyword','') }}" placeholder="Search…" name="keyword" aria-label="Search in website">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="2%">{{ __('sl') }}</th>
                                <th width="5%">{{ __('image') }}</th>
                                <th width="10%">{{ __('name') }}</th>
                                <th width="10%">{{ __('email') }}</th>
                                <th width="10%">{{ __('username') }}</th>
                                <th width="5%">{{ __('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $key =>$customer)
                                <tr>
                                    <td class="text-center" tabindex="0">{{ $key+1 }}
                                    </td>
                                    <td class="text-center" tabindex="0">
                                        <img src="{{ asset($customer->image) }}" class="rounded" height="50px"
                                            width="50px" alt="image">
                                    </td>
                                    <td class="text-center" tabindex="0">{{ $customer->name }}</td>
                                    <td class="text-center" tabindex="0">{{ $customer->email }}</td>
                                    <td class="text-center" tabindex="0">{{ $customer->username }}</td>
                                    <td class="text-center" tabindex="0">
                                        <a data-toggle="tooltip" data-placement="top" title="{{ __('customer_details') }}"
                                        href="{{ route('module.customer.show', $customer) }}"
                                        class="btn bg-warning"><i class="fas fa-eye"></i></a>

                                        <a data-toggle="tooltip" data-placement="top" title="{{ __('view_customer_ads') }}"
                                        href="{{ route('module.ad.index',['customer'=>$customer->username]) }}"
                                        class="btn bg-info">
                                        <i class="fab fa-adversal"></i>
                                    </a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <x-not-found word="Customer" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <style>
        .page-link.page-navigation__link.active {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
    </style>
@endsection



@section('script')
<script>
    const customer_type = document.getElementById('customer_type_select')

    customer_type.addEventListener('change', function(){
        document.getElementById('customer_type').value = customer_type_select.value
        document.getElementById('customerSearchForm').submit()
    })
</script>
@endsection
