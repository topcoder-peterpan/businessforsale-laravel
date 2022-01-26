@extends('layouts.backend.admin')

@section('title') {{ __('city') }} @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="line-height: 36px;">{{ __('city_list') }}</h3>
                    @if (userCan('city.create'))
                    <a href="{{ route('module.city.create') }}"
                        class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus"></i>&nbsp; {{ __('add_city') }}
                    </a>
                    @endif
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">{{ __('sl') }}</th>
                                <th width="5%">{{ __('image') }}</th>
                                <th>{{ __('city_name') }}</th>
                                <th>{{ __('created_date') }}</th>
                                <th>{{ __('last_updated') }}</th>
                                @if (userCan('city.update') || userCan('city.delete'))
                                <th width="10%">{{ __('actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cities as $city)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img style="width: 50px"
                                        src="{{ $city->image ? asset($city->image) : asset('backend/image/default-ad.jpg') }}">
                                </td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->created_at->diffForHumans() }}</td>
                                <td>{{ $city->updated_at->diffForHumans() }}</td>
                                @if (userCan('city.update') || userCan('city.delete'))
                                <td class="d-flex justify-content-center align-items-center">
                                    @if (userCan('city.update'))
                                    <a title="{{ __('edit_city') }}" href="{{ route('module.city.edit', $city->id) }}"
                                        class="btn bg-info mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    @if (userCan('city.delete'))
                                        <form action="{{ route('module.city.delete', $city->id) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button data-toggle="tooltip" data-placement="top"
                                                title="{{ __('delete_city') }}"
                                                onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <x-not-found word="City" route="module.city.create" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($cities->total() > $cities->count())
                <div class="card-footer ">
                    <div class="d-flex justify-content-center">
                        {{ $cities->links() }}
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
