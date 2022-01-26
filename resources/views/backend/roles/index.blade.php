@extends('layouts.backend.admin')
@section('title') {{ __('roles') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('roles_list') }}</h3>
                        @if (userCan('role.create'))
                            <a href="{{ route('role.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus"></i>&nbsp; {{ __('create_role') }}</a>
                        @endif
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('sl') }}</th>
                                    <th width="20%">{{ __('name') }}</th>
                                    <th>{{ __('permission') }}</th>
                                    @if (userCan('role.update') || userCan('role.delete'))
                                        <th width="10%">{{ __('actions') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ ucwords($role->name) }}</td>
                                        <td class="permission-name">
                                            @foreach ($role->permissions as $item)
                                                <span class="badge badge-primary">{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        @if (userCan('role.update') || userCan('role.delete'))
                                            <td>
                                                @if (userCan('role.update'))
                                                    <a href="{{ route('role.edit', $role->id) }}" class="btn bg-info"><i
                                                            class="fas fa-edit"></i></a>
                                                @endif
                                                @if (userCan('role.delete'))
                                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
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
                                            <x-not-found word="Role" route="role.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('style')
    <style>
        .permission-name{
            display: flex;
            flex-wrap: wrap
        }

         .permission-name span{
             margin: 3px;
         }
    </style>
@endsection
