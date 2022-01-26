@extends('layouts.frontend.layout_one')

@section('title',__('website.message'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_messenger_background_path">
        {{ __('website.overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}" class="breedcrumb__page-link text--body-3">{{ __('website.dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.message') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="dashboard__message ">
                        <div class="dashboard__message-left dashboard__message-users">
                            <h2 class="title text--body-2-600">{{ __('website.message') }}</h2>
                            <div class="dashboard__message-userscontent">
                                @forelse ($users as $chatuser)
                                    <x-messenger.user-list :user="$chatuser"></x-messenger.user-list>
                                @empty
                                    <div class="user user--profile active">
                                        <div class="user-info">
                                            <p class="message-hint center-el"><span>{{ __('website.empty_contact') }}</span></p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="dashboard__message-right dashboard__message-user">
                            <div class="message-header">
                                @if (!is_null($selected_user))
                                    <x-messenger.message-header :user="$selected_user"></x-messenger.message-header>
                                @endif
                            </div>

                            <div class="message-body">
                                @if (!is_null($selected_user))
                                    @forelse ($messages as $message)
                                        <x-messenger.message :message="$message" :user="$selected_user"></x-messenger.message>
                                    @empty
                                        <p class="message-hint center-el" style="text-align:center;margin-top:30px;"><span>{{ __('website.empty_message') }}</span></p>
                                    @endforelse
                                @else
                                <div class="vertical-center">
                                    <p>Select someone to start conversation</p>
                                </div>
                                @endif
                            </div>
                            <div class="message-footer">
                                @if (!is_null($selected_user))
                                    <x-messenger.message-form :user="$selected_user"></x-messenger.message-form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection
