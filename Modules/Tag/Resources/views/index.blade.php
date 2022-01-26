@extends('layouts.backend.admin')
@section('title') {{ __('tag_list') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('tag_list') }}</h3>
                        @if (userCan('tag.create'))
                            <a href="{{ route('module.tag.create') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus"></i>&nbsp; {{ __('add_tag') }}
                            </a>
                        @endif
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            @if ($tags->count() > 0)
                                <thead>
                                    <tr>
                                        <th width="5%">{{ __('sl') }}</th>
                                        <th>{{ __('tag_name') }}</th>
                                        <th>{{ __('created_date') }}</th>
                                        <th>{{ __('last_updated') }}</th>
                                        @if (userCan('tag.update') || userCan('tag.delete'))
                                        <th width="10%">{{ __('actions') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr id="item_id{{ $tag->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->created_at->diffForHumans() }}</td>
                                        <td>{{ $tag->updated_at->diffForHumans() }}</td>
                                        @if (userCan('tag.update') || userCan('tag.delete'))
                                        <td class="d-flex justify-content-center align-items-center">
                                            @if (userCan('tag.update'))
                                            <a title="{{ __('edit_tag') }}" href="{{ route('module.tag.edit', $tag->id) }}" class="btn bg-info mr-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endif
                                            @if (userCan('tag.delete'))
                                                <form action="{{ route('module.tag.destroy', $tag->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('delete_tag') }}"
                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item?') }}');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="Tag" route="module.tag.create" />
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
