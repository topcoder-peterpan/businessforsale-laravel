@extends('layouts.backend.admin')
@section('title') {{ __('plan_list') }} @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="text-right" style="margin-bottom: 10px">
                @if (userCan('plan.create') && $plans->count() < 3)
                    <a href="{{ route('module.plan.create') }}" class="btn2"><i class="fas fa-plus"></i>&nbsp; {{ __('add_plan') }}</a>
                @endif
            </div>
        </div>
        @if (userCan('plan.update') && $plans->count())
        <div class="row">
            <form action="{{ route('module.plan.recommended') }}" method="POST">
                @csrf
                <div class="form-row align-items-center">
                  <div class="col-auto my-1">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">{{ __('set_recommended_package') }}</label>
                    <select name="plan_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option value="" hidden>{{ __('select_plan') }}</option>
                        @foreach ($plans as $plan)
                            <option {{ $plan->recommended ? 'selected':'' }} value="{{ $plan->id }}">{{ $plan->label }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-auto my-2 py-2 ">
                    <button type="submit" class="btn btn-primary " style="margin-top:25px">{{ __('save') }}</button>
                  </div>
                </div>
            </form>
        </div>
        @endif
        <div class="row">
            @forelse ($plans as $plan)
            <div class="col-sm-12 col-md-6 col-xxl-4 mb-5">
                <div class="plan-card plan-card--active">
                    <div class="plan-card__top">

                        @if ($plan->recommended)
                            <span class="cards__tag text--body-5" style="background-color: #28a745"> {{ __('recommended') }}</span>
                        @endif

                        <h2 class="plan-card__title text--body-1">{{ $plan->label }}</h2>
                        <div class="plan-card__price">
                            <h5 class="text--display-3">${{ $plan->price }}</h5>
                        </div>
                    </div>
                    <div class="plan-card__bottom">
                        <div class="plan-card__package">
                            <div class="plan-card__package-list active">
                                <span class="icon">
                                    <x-svg.check-icon/>
                                </span>
                                <h5 class="text--body-3">{{ __('ads_limit') }} : {{ $plan->ad_limit }}</h5>
                            </div>
                            <div class="plan-card__package-list active">
                                <span class="icon">
                                    <x-svg.check-icon/>
                                </span>
                                <h5 class="text--body-3">{{ __('featured_ads_limit') }} : {{ $plan->featured_limit }}</h5>
                            </div>
                            <div class="plan-card__package-list {{ $plan->badge == true ? 'active' : '' }}">
                                <span class="icon">
                                    <x-svg.check-icon/>
                                </span>
                                <h5 class="text--body-3">{{ __('badge') }}</h5>
                            </div>
                            <div class="plan-card__package-list {{ $plan->multiple_image == true ? 'active' : '' }}">
                                <span class="icon">
                                    <x-svg.check-icon/>
                                </span>
                                <h5 class="text--body-3">{{ __('multiple_image') }}</h5>
                            </div>
                            <div class="plan-card__package-list {{ $plan->customer_support == true ? 'active' : '' }}">
                                <span class="icon">
                                    <x-svg.check-icon/>
                                </span>
                                <h5 class="text--body-3">{{ __('customer_support') }}</h5>
                            </div>
                        </div>
                    </div>
                    @if (userCan('plan.update') || userCan('plan.delete'))
                        <div class="sss">
                            @if (userCan('plan.update'))
                                <a href="{{ route('module.plan.edit', $plan->id) }}" class="plan-card__select-pack btn btn--bg dddd" data-bs-toggle="modal" data-bs-target="#planModal">
                                    <i class="fas fa-edit"></i>
                                    {{ __('edit_plan') }}
                                </a>
                            @endif

                            @if (userCan('plan.delete'))
                            <form action="{{ route('module.plan.delete', $plan->id) }}" class="plan-card__select-pack fff" method="POST" onclick="return confirm('Are You Sure?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn--bg">
                                    <i class="fas fa-trash"></i>
                                    {{ __('delete_plan') }}
                                </button>
                            </form>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-body" style="padding:55px">
                        <img src="{{ asset('backend/image') }}/not-found.svg" height="128px" class="plan-img">
                        <h5 class="plan-h5">{{ __('no_results_found') }}</h5>
                        <p class="plan-p">{{ __('there_is_no_plan_found_in_this_page') }}.</p>
                        <a href="{{ route('module.plan.create') }}" class="plan-btn">
                            <x-svg.plus-icon/>
                            {{ __('add_your_first_plan') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
<style>

    .plan-img{
        width: 208px;
    }
    .plan-h5{
        margin-top: 20px;
    }
    .plan-p{
        color: #6c757d!important;
        margin-top: 10px;
    }
    .plan-btn{
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        box-shadow: none;
        padding: .375rem .75rem;
        font-weight: 400;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        border: 1px solid transparent;
        margin-top: 15px;
    }
    .plan-btn:hover{
        color: #fff;
        background-color: #0062cc;
    }
    .nav-link img{
        width: 20px;
        height: 20px;
    }
    .sss{
        display: flex;
        justify-content: space-between;
    }
    .btn--bg{
        width:100%;
    }
    .fff{
        width:100%;
    }
    .dddd{
        margin-right:1px;
    }
    .plan-card__price {
        margin-bottom: 0;
    }
    .btn2 {
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        color: #fff;
        background-color: #007bff;
        font-weight: 400;
        padding: .375rem .75rem;
    }
    .btn2:hover {
        background-color: #0062cc;
        color: #fff;
    }
    .plan-card{
        position: relative;
    }
    .cards__tag{
        left: -40px;
        padding: 8px 57px 8px 30px;
    }
</style>
@endsection
