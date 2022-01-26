@extends('layouts.backend.admin')
@section('title') {{ __('faq_list') }} @endsection
@section('content')
<div class="text-right mb-3">
    @if (userCan('faq.create'))
    <a href="{{ route('module.faq.create') }}" class="btn btn-primary"><i
        class="fas fa-plus"></i> {{ __('add_faq') }}</a>
    @endif
</div>
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills mb-3">
            @foreach ($faq_category as $category)
            <li class="nav-item mr-3" role="presentation">
                <a class="nav-link active" href="{{ route('module.faq.index', $category->slug) }}" >{{ $category->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        @foreach ($faqs as $faq)
        <div class="col-12" id="accordion">
            <div class="card card-primary card-outline">
                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse{{ $faq->id }}" aria-expanded="false">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            {{ $loop->iteration }}. {{ $faq->question }}
                        </h4>
                    </div>
                </a>
                <div id="collapse{{ $faq->id }}" class="collapse" data-parent="#accordion" style="">
                    <div class="card-body">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @if (userCan('faq.update') || userCan('faq.delete') )
                <div class="d-flex justify-content-end">
                    @if (userCan('faq.update'))
                        <a href="{{ route('module.faq.edit', $faq->id) }}"> <i class="fas fa-edit"></i> </a>
                    @endif
                    @if (userCan('faq.delete'))
                    <form
                        action="{{ route('module.faq.destroy', $faq->id) }}"
                        method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button data-toggle="tooltip" data-placement="top"
                            title="{{ __('delete_subcategory') }}"
                            onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                            class="btn p-0 ml-2 text-danger"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
