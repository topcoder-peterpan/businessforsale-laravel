@extends('backend.settings.setting-layout')
@section('title') {{ __('website_setting') }} @endsection

@section('color-picker')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('color_picker') }}</h3>
        </div>
        <div class="row pt-3 pb-4 justify-content-center">
            <form id="color_picker_form" action="" method="post">
                @csrf
                @method('PUT')
                <input id="sidebar_color_id" type="hidden" name="sidebar_color"
                    value="{{ $settings->sidebar_color ? $settings->sidebar_color : '#343a40' }}">
                <input id="nav_color_id" type="hidden" name="nav_color"
                    value="{{ $settings->nav_color ? $settings->nav_color : '#f8f9fa' }}">
            </form>
            <div class="col-2">
                <div class="card">
                    <div class="card-header">{{ __('sidebar_color') }}</div>
                    <div class="card-body">
                        <div class="sidebar-color-picker"></div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <div class="card-header">{{ __('navbar_color') }}</div>
                    <div class="card-body">
                        <div class="navbar-color-picker"></div>
                    </div>
                </div>
            </div>
        </div>
        @if (userCan('setting.update'))
        <div class="card-footer text-center">
            <button style="width: 250px;" onclick="$('#color_picker_form').submit()" type="submit"
                class="btn btn-primary">{{ __('update') }}</button>
        </div>
        @endif
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/pickr') }}/classic.min.css" />
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/pickr') }}/pickr.min.js"></script>
    <script>
        var sidebarColor = '{{ $settings->sidebar_color ? $settings->sidebar_color : '#343a40' }}';
        var navbarColor = '{{ $settings->nav_color ? $settings->nav_color : '#f8f9fa' }}';

        // Sidebar Color Change
        const sidebarPickr = Pickr.create({
            el: ".sidebar-color-picker",
            theme: "classic",
            default: sidebarColor,

            components: {
                preview: true,
                opacity: true,
                hue: true,

                interaction: {
                    hex: true,
                    rgba: true,
                    cmyk: true,
                    input: true,
                    save: true,
                    clear: true,
                }
            }
        });
        sidebarPickr.on('change', (color, source, instance) => {
            $("#sidebar").css("backgroundColor", color.toRGBA().toString(0));
            $("#sidebar_color_id").val(color.toRGBA().toString(0));
        }).on('save', (color, instance) => {
            $("#sidebar").css("backgroundColor", color.toRGBA().toString(0));
            $("#sidebar_color_id").val(color.toRGBA().toString(0));
            sidebarPickr.hide();
        }).on('clear', instance => {
            sidebarPickr.hide();
        });

        // Navbar Color Change
        const NavbarPickr = Pickr.create({
            el: ".navbar-color-picker",
            theme: "classic",
            default: navbarColor,

            components: {
                preview: true,
                opacity: true,
                hue: true,

                interaction: {
                    hex: true,
                    rgba: true,
                    cmyk: true,
                    input: true,
                    save: true,
                    clear: true,
                }
            }
        });

        NavbarPickr.on('change', (color, source, instance) => {
            $("#nav").css("backgroundColor", color.toRGBA().toString(0));
            $("#nav_color_id").val(color.toRGBA().toString(0));
        }).on('save', (color, instance) => {
            $("#nav").css("backgroundColor", color.toRGBA().toString(0));
            $("#nav_color_id").val(color.toRGBA().toString(0));
            NavbarPickr.hide();
        }).on('clear', instance => {
            $("#nav").css("backgroundColor", navbarColor);
            NavbarPickr.hide();
        });
    </script>
@endsection
