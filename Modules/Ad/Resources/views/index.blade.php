@extends('layouts.backend.admin')

@section('title')
{{ __('ad_list') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="line-height: 36px;">{{ __('ad_list') }}
                        @if (request('category') && $category !=null)
                            <strong>
                                - Filter By Category: {{ $category->name }}
                            </strong>
                        @endif
                        @if (request('customer') && $customer !=null)
                            <strong>
                                - Filter By Customer: {{ $customer->name }}
                            </strong>
                        @endif
                        @if (request('city') && $city !=null)
                            <strong>
                                - Filter By City: {{ $city->name }}
                            </strong>
                        @endif
                        @if (request('keyword'))
                            <strong>
                                - Filter By Keyword: {{ request('keyword') }}
                            </strong>
                        @endif
                    </h3>
                    <div class="col-md-4 d-flex justify-content-between align-items-center ml-auto">
                        <div class="col-md-{{ request('keyword') || request('category') || request('city') || request('customer') ? '9':'12' }}">
                            <form action="{{ route('module.ad.index')  }}" method="GET">
                                <input type="text" value="{{ request('keyword') }}" class="form-control" placeholder="Search…" name="keyword" aria-label="Search in website">
                            </form>
                        </div>
                        @if (request('keyword') || request('category') || request('city') || request('customer'))
                            <div class="col-md-3">
                                    <a href="{{ route('module.ad.index')  }}" class="btn btn-danger" style="margin-top: 0px;">Clear</a>

                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="2%">{{ __('sl') }}</th>
                                <th width="5%">{{ __('thumbnail') }}</th>
                                <th width="10%">{{ __('name') }}</th>
                                <th width="10%">{{ __('price') }}</th>
                                <th width="10%">{{ __('category') }}</th>
                                <th width="10%">{{ __('city') }}</th>
                                <th width="10%">{{ __('customer_name') }}</th>
                                <th width="5%">{{ __('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ads as $key =>$ad)
                            <tr>
                                <td class="text-center" tabindex="0">{{ $key+1 }}
                                </td>
                                <td class="text-center" tabindex="0">
                                    <img src="{{ asset($ad->thumbnail) }}" class="rounded" height="50px" width="50px"
                                        alt="image">
                                </td>
                                <td class="text-center" tabindex="0">{{ $ad->title }}
                                </td>
                                <td class="text-center" tabindex="0">{{ $ad->price }}
                                </td>
                                <td class="text-center" tabindex="0">
                                    <a
                                        href="{{ route('module.ad.index',['category'=>$ad->category->slug]) }}">{{ $ad->category->name }}</a>
                                </td>
                                <td class="text-center" tabindex="0">
                                    <a
                                        href="{{ route('module.ad.index',['city'=>$ad->city->name]) }}">{{ $ad->city->name }}</a>
                                </td>
                                <td class="text-center" tabindex="0">
                                    <a
                                        href="{{ route('module.ad.index',['customer'=>$ad->customer->username]) }}">{{ $ad->customer->username }}</a>
                                </td>
                                <td class="text-center" tabindex="0">

                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Options
                                    </button>
                                    <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        <li><a class="dropdown-item" href="{{ route('module.ad.show', $ad->slug) }}">
                                            <i class="fas fa-eye text-info"></i> View Details
                                        </a></li>

                                        <li><a class="dropdown-item" href="{{ route('module.ad.edit', $ad->id) }}">
                                            <i class="fas fa-edit text-success"></i> Edit Ad
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('module.ad.show_gallery', $ad->id) }}">
                                            <i class="fas fa-images text-primary"></i></i> Ad Gallery
                                        </a></li>
                                        <li>
                                            <form action="{{ route('module.ad.destroy', $ad->id) }}" method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fas fa-trash text-danger"></i> Delete Ad
                                                </button>
                                            </form>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">
                                    <x-not-found word="Ad" />
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($ads->total() > $ads->count())
                    <div class="card-footer ">
                        <div class="d-flex justify-content-center">
                            {{ $ads->links() }}
                        </div>
                    </div>
                @endif
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
