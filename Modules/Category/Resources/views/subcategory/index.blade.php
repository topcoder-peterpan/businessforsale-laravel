@php
$user = auth()->user();
@endphp

@extends('layouts.backend.admin')

@section('title') {{ __('subcategory_list') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('add_subcategory') }}</h3>
                        @if (userCan('subcategory.create'))
                            <a href="{{ route('module.subcategory.create') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus"></i>&nbsp; {{ __('add_subcategory') }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row" class="text-center">
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending"
                                                    aria-sort="descending" width="40%">{{ __('subcategory_name') }}</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending"
                                                    aria-sort="descending" width="40%">{{ __('category_name') }}</th>
                                                    @if (userCan('subcategory.update') || userCan('subcategory.delete'))
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                                    width="18%"> {{ __('actions') }}</th>
                                                    @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sub_categories as $subcategory)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        {{ $subcategory->name }}</td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        {{ $subcategory->category->name }}</td>
                                                        @if (userCan('subcategory.update') || userCan('subcategory.delete'))
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        @if (userCan('subcategory.update'))
                                                            <a data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('edit_subcategory') }}"
                                                                href="{{ route('module.subcategory.edit', $subcategory->id) }}"
                                                                class="btn bg-info"><i class="fas fa-edit"></i></a>
                                                        @endif
                                                        @if (userCan('subcategory.delete'))
                                                            <form
                                                                action="{{ route('module.subcategory.destroy', $subcategory->id) }}"
                                                                method="POST" class="d-inline">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button data-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('delete_subcategory') }}"
                                                                    onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                                    class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
    </script>
@endsection
