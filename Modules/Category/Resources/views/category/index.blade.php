@php
$user = auth()->user();
@endphp

@extends('layouts.backend.admin')

@section('title') {{ __('category_list') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('category_list') }}</h3>
                        @if (userCan('category.create'))
                            <a href="{{ route('module.category.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus"></i>&nbsp; {{ __('add_category') }}</a>
                        @endif
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th width="10%">{{ __('image') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('icon') }}</th>
                                    @if (userCan('category.update') || userCan('category.delete'))
                                    <th width="10%">{{ __('actions') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @forelse ($categories as $category)
                                <tr data-id="{{ $category->id }}">
                                    <td class="text-center">
                                        <img width="50px" height="50px" src="{{ $category->image ? asset($category->image) : asset('backend/image/default-ad.jpg') }}" alt="category image">
                                    </td>
                                    <td class="text-center">{{ $category->name }}</td>
                                    <td class="text-center"><i class="{{ $category->icon }}"></i>&nbsp;&nbsp;&nbsp;({{ $category->icon }})</td>
                                    @if (userCan('category.update') || userCan('category.delete'))
                                    <td class="text-center">
                                        @if (userCan('category.update'))
                                            <div class="handle btn btn-success mt-0"><i class="fas fa-hand-rock"></i></div>
                                            <a title="{{ __('edit_category') }}" href="{{ route('module.category.edit', $category->id) }}" class="btn bg-info mr-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        @if (userCan('category.delete'))
                                            <form action="{{ route('module.category.destroy', $category->id) }}"
                                                method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('delete_category') }}"
                                                    onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                    class="btn bg-danger mr-1"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <x-not-found word="Category" route="module.category.create" />
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($categories->total() > $categories->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                dropOnEmpty: false,
                update: function() {
                    sendTaskOrderToServer('#sortable tr');
                },
                classes: {
                    "ui-sortable": "highlight"
                },
            });
            $("#sortable").disableSelection();

            function sendTaskOrderToServer(selector) {
                var order = [];
                $(selector).each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('module.category.updateOrder') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    }
                });
            }
        });
    </script>
@endsection
