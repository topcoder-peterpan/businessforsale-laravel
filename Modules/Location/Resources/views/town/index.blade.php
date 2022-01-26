@extends('layouts.backend.admin')

@section('title') {{ __('town_list') }} @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="line-height: 36px;">{{ __('town_list') }}</h3>
                    @if (userCan('town.create'))
                    <a href="{{ route('module.town.create') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus"></i>&nbsp; {{ __('add_town') }}
                    </a>
                    @endif
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">{{ __('sl') }}</th>
                                <th>{{ __('city_name') }}</th>
                                <th>{{ __('town_name') }}</th>
                                <th>{{ __('created_date') }}</th>
                                <th>{{ __('last_updated') }}</th>
                                @if (userCan('town.update') || userCan('town.delete'))
                                <th width="10%">{{ __('actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($towns as $town)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $town->city->name }}</td>
                                <td>{{ $town->name }}</td>
                                <td>{{ $town->created_at->diffForHumans() }}</td>
                                <td>{{ $town->updated_at->diffForHumans() }}</td>
                                @if (userCan('town.update') || userCan('town.delete'))
                                    <td class="d-flex justify-content-center align-items-center">
                                        @if (userCan('town.update'))
                                            <a title="{{ __('edit_town') }}" href="{{ route('module.town.edit', $town->id) }}" class="btn bg-info mr-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        @if (userCan('town.delete'))
                                            <form action="{{ route('module.town.delete', $town->id) }}"
                                                method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('delete_town') }}"
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
                                        <x-not-found word="Town" route="module.town.create" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($towns->total() > $towns->count())
                <div class="card-footer ">
                    <div class="d-flex justify-content-center">
                        {{ $towns->links() }}
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
