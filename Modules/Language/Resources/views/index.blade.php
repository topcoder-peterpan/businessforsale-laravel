@extends('layouts.backend.admin')

@section('title') {{ __('language_list') }} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('language_list') }}</h3>
                        <a href="{{ route('language.create') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-plus"></i>&nbsp; {{ __('add_language') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('sl') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th width="15%">{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($languages as $key => $language)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $language->name }}</td>
                                    <td>{{ $language->code }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('language.view', $language->code) }}" class="btn btn-secondary mr-2"><i class="fas fa-cog"></i></a>
                                        <a href="{{ route('language.edit', $language->id) }}" class="btn btn-info mt-0 mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('language.delete', $language->id) }}" class="d-inline" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button data-toggle="tooltip" data-placement="top"
                                            title="{{ __('delete_language') }}"
                                            onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <x-not-found word="language" route="language.create" />
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
