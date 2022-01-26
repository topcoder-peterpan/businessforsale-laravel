@php
$user = auth()->user();
@endphp
@if (userCan('setting.update'))
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fas fa-plus"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <span class="dropdown-item dropdown-header">{{ __('quick_actions') }}</span>
            <div class="dropdown-divider"></div>
            <div class="row row-paddingless" style="padding-left: 15px; padding-right: 15px;">
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('user.create') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-users"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_user') }}</span>
                    </a>
                </div>
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('role.create') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-lock"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_role') }}</span>
                    </a>
                </div>
            </div>
            <div class="row row-paddingless" style="padding-left: 15px; padding-right: 15px;">
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('module.category.create') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-tags"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_category') }}</span>
                    </a>
                </div>
                @if ($appearance_enable)
                    <div class="col-6 p-0 border-bottom border-right">
                        <a href="{{ route('module.themes.index') }}" class="d-block text-center py-3 bg-hover-light"> <i
                                class="fas fa-adjust"></i>
                            <span class="w-100 d-block text-muted">{{ __('change_skin') }}</span>
                        </a>
                    </div>
                @endif
                <div class="col-12 p-0 border-bottom border-right">
                    <a href="{{ route('setting', 'website') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-cog"></i>
                        <span class="w-100 d-block text-muted">{{ __('setting') }}</span>
                    </a>
                </div>
            </div>
            <div class="dropdown-divider"></div>
        </div>
    </li>
    @if ($language_enable)
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-language" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $settings->dark_mode ? '#ffffff':'#1f2d3d' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 5h7" />
                    <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                    <path d="M5 9c-.003 2.144 2.952 3.908 6.7 4" />
                    <path d="M12 20l4 -9l4 9" />
                    <path d="M19.1 18h-6.2" />
                  </svg>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;">
                <a class="dropdown-item {{ session('lang') === 'default' ? 'active' : '' }}" href="{{ route('changeLanguage', 'default') }}">
                    English (default)
                </a>
                @foreach (languages() as $lang)
                    <a class="dropdown-item {{ session('lang') === $lang->code ? 'active' : '' }}" href="{{ route('changeLanguage', $lang->code) }}">
                        {{ $lang->name }}
                    </a>
                @endforeach
            </div>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>

    @if ($appearance_enable)
        <li class="nav-item">
            <form action="{{ route('setting', 'dark_mode') }}" method="post" id="mode_form">
                @csrf
                @method("PUT")
                @if ($settings->dark_mode)
                    <input type="hidden" name="dark_mode" value="0">
                @else
                    <input type="hidden" name="dark_mode" value="1">
                @endif
            </form>
            <a onclick="$('#mode_form').submit()" class="nav-link" href="#" role="button">
                @if ($settings->dark_mode)
                    <x-svg.sun-icon/>
                @else
                <x-svg.moon-icon/>
                @endif
            </a>
        </li>
    @endif
@endif

<li class="nav-item dropdown user-menu">
    <a href="{{ route('profile') }}" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        @if ($user->image)
            <img src="{{ asset($user->image) }}" class="user-image img-circle elevation-2" alt="User Image">
        @else
            <img src="{{ asset('backend/image/default.png') }}" class="user-image img-circle elevation-2"
                alt="User Image">
        @endif
        <span class="d-none d-md-inline">{{ $user->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded border-0" style="left: inherit; right: 0px;">
        <!-- User image -->
        <li class="user-header bg-primary rounded-top">
            @if ($user->image)
                <img src="{{ asset($user->image) }}" class="user-image img-circle elevation-2" alt="User Image">
            @else
                <img src="{{ asset('backend/image/default.png') }}" class="user-image img-circle elevation-2"
                    alt="User Image">
            @endif
            <p>
                {{ $user->name }} -
                @foreach ($user->getRoleNames() as $role)
                    ( <span>{{ ucwords($role) }}</span> )
                @endforeach
                <small>{{ __('member_since') }} {{ $user->created_at->format('M d, Y') }}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer border-bottom d-flex">
            <a href="{{ route('profile') }}" class="btn btn-default">{{ __('profile') }}</a>
            <a href="javascript:void(0)"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="btn btn-default ml-auto">{{ __('sign_out') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none invisible">
                @csrf
            </form>
        </li>
    </ul>
</li>
