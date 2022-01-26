<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4"
    style="background-color: {{ $settings->dark_mode ? '' : $settings->sidebar_color }}">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand_logo">
        <img src="{{ $settings->logo_image2 ? asset($settings->logo_image2):asset('backend/image/logo-default.png') }}"
            alt="Logo" class="">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div class="avatar">
                    <img src="{{ $user->image ? asset($user->image):asset('backend/image/default.png') }}"
                        class="elevation-2" alt="User Image">
                </div>
            </div>
            <div class="info">
                <a href="{{ route('profile') }}" class="d-block">{{ $user->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat"
                data-widget="treeview" role="menu" data-accordion="false">
                {{-- Dashboard  --}}
                <x-sidebar-list :linkActive="Route::is('home') ? true : false" route="home"
                    icon="fas fa-tachometer-alt">
                    {{ __('dashboard') }}
                </x-sidebar-list>

                {{-- Newsletter Subscription --}}
                @if (Module::collections()->has('Newsletter') && $newsletter_enable)
                    @if (userCan('newsletter.view') || userCan('newsletter.mailsend'))
                        <x-sidebar-dropdown
                            :linkActive="Route::is('module.newsletter.index') || Route::is('module.newsletter.send_mail') ? true : false"
                            :subLinkActive="Route::is('module.newsletter.index') || Route::is('module.newsletter.send_mail') ? true : false"
                            icon="fas fa-envelope">
                            @slot('title')
                            {{ __('newsletter') }}
                            @endslot

                            @if (userCan('newsletter.view'))
                                <ul class="nav nav-treeview">
                                    <x-sidebar-list :linkActive="Route::is('module.newsletter.index') ? true : false"
                                        route="module.newsletter.index" icon="fas fa-circle">
                                        {{ __('emails') }}
                                    </x-sidebar-list>
                                </ul>
                            @endif
                            @if (userCan('newsletter.mailsend'))
                                <ul class="nav nav-treeview">
                                    <x-sidebar-list :linkActive="Route::is('module.newsletter.send_mail') ? true : false"
                                    route="module.newsletter.send_mail" icon="fas fa-circle">
                                    {{ __('send_mail') }}
                                </x-sidebar-list>
                            </ul>
                            @endif

                        </x-sidebar-dropdown>
                    @endif
                @endif

                {{-- Ad  --}}
                @if (Module::collections()->has('Ad') || Module::collections()->has('Category') ||
                Module::collections()->has('Brand') || Module::collections()->has('Location'))
                @if (userCan('ad.view') || userCan('category.view') || userCan('subcategory.view') ||
                userCan('brand.view') || userCan('city.view') || userCan('town.view'))
                <x-sidebar-dropdown
                    :linkActive="Route::is('module.ad.index') ||Route::is('module.ad.show') ||Route::is('module.category.index') || Route::is('module.category.create') || Route::is('module.category.edit') || Route::is('module.subcategory.index') || Route::is('module.subcategory.create') || Route::is('module.subcategory.edit') || Route::is('module.brand.index') || Route::is('module.brand.create') || Route::is('module.brand.edit') || Route::is('module.city.index') || Route::is('module.city.create') || Route::is('module.city.edit') || Route::is('module.town.index') || Route::is('module.town.create') || Route::is('module.town.edit') || Route::is('module.ad.create') || Route::is('module.ad.edit') ? true : false"
                    :subLinkActive="Route::is('module.ad.index') ||Route::is('module.ad.show') || Route::is('module.category.index') || Route::is('module.category.create') || Route::is('module.category.edit') || Route::is('module.subcategory.index') || Route::is('module.subcategory.create') || Route::is('module.subcategory.edit') || Route::is('module.brand.index') || Route::is('module.brand.create') || Route::is('module.brand.edit') || Route::is('module.city.index') || Route::is('module.city.create') || Route::is('module.city.edit') || Route::is('module.town.index') || Route::is('module.town.create') || Route::is('module.town.edit') ? true : false"
                    icon="fab fa-adversal">
                    @slot('title')
                    {{ __('ads') }}
                    @endslot
                    @if (Module::collections()->has('Ad'))
                    @if (userCan('ad.create'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list :linkActive="Route::is('module.ad.create') ? true : false"
                            route="module.ad.create" icon="fas fa-circle">
                            {{ __('create_ad') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (userCan('ad.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.ad.index') || Route::is('module.ad.show') ? true : false"
                            route="module.ad.index" icon="fas fa-circle">
                            {{ __('ad') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @endif
                    @if (Module::collections()->has('Category'))
                    @if (userCan('category.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.category.index') || Route::is('module.category.create') || Route::is('module.category.edit') ? true : false"
                            route="module.category.index" icon="fas fa-circle">
                            {{ __('category') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (userCan('subcategory.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.subcategory.index') || Route::is('module.subcategory.create') || Route::is('module.subcategory.edit') ? true : false"
                            route="module.subcategory.index" icon="fas fa-circle">
                            {{ __('subcategory') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @endif
                    @if (Module::collections()->has('Brand') && userCan('brand.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.brand.index') || Route::is('module.brand.create') || Route::is('module.brand.edit') ? true : false"
                            route="module.brand.index" icon="fas fa-circle">
                            {{ __('brand') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (Module::collections()->has('Location'))
                    @if (userCan('city.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.city.index') || Route::is('module.city.create') || Route::is('module.city.edit') ? true : false"
                            route="module.city.index" icon="fas fa-circle">
                            {{ __('city') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (userCan('town.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.town.index') || Route::is('module.town.create') || Route::is('module.town.edit') ? true : false"
                            route="module.town.index" icon="fas fa-circle">
                            {{ __('town') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @endif
                </x-sidebar-dropdown>
                @endif
                @endif

                {{-- Customer  --}}
                @if (Module::collections()->has('Customer') && userCan('customer.view'))
                <li class="nav-item">
                    <a href="{{ route('module.customer.index') }}"
                        class="nav-link {{ Route::is('module.customer.index') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>{{ __('customer') }}</p>
                    </a>
                </li>
                @endif

                {{-- Plan  --}}
                @if (Module::collections()->has('Plan') && userCan('plan.view') && $priceplan_enable)
                <x-sidebar-list
                    :linkActive="Route::is('module.plan.index') || Route::is('module.plan.create') ? true : false"
                    route="module.plan.index" icon="fas fa-money-check">
                    {{ __('pricing_plan') }}
                </x-sidebar-list>
                @endif

                {{-- Blog and Tag --}}
                @if (Module::collections()->has('Blog') || Module::collections()->has('Tag'))
                @if ($blog_enable)
                @if (userCan('post.view') || userCan('tag.view'))
                <x-sidebar-dropdown
                    :linkActive="Route::is('module.post.index') || Route::is('module.post.create') || Route::is('module.post.edit') || Route::is('module.tag.index') || Route::is('module.tag.create') || Route::is('module.tag.edit') ? true : false"
                    :subLinkActive="Route::is('module.post.index') || Route::is('module.post.create') || Route::is('module.post.edit') || Route::is('module.tag.index') || Route::is('module.tag.create') || Route::is('module.tag.edit') ? true : false"
                    icon="fas fa-blog">
                    @slot('title')
                    {{ __('blog') }}
                    @endslot

                    @if (userCan('post.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.post.index') || Route::is('module.post.create') || Route::is('module.post.edit') ? true : false"
                            route="module.post.index" icon="fas fa-circle">
                            {{ __('post') }}
                        </x-sidebar-list>
                    </ul>
                    @endif

                    @if (userCan('tag.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.tag.index') || Route::is('module.tag.create') || Route::is('module.tag.edit') ? true : false"
                            route="module.tag.index" icon="fas fa-circle">
                            {{ __('tag') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                </x-sidebar-dropdown>
                @endif
                @endif
                @endif

                {{-- Testimonial, contact, faqcategory and faq --}}
                @if (userCan('testimonial.view') || userCan('contact.view') || userCan('faqcategory.view') ||
                userCan('faq.view'))
                <x-sidebar-dropdown
                    :linkActive="Route::is('module.testimonial.index') || Route::is('module.testimonial.create') || Route::is('module.testimonial.edit') || Route::is('module.contact.index') || Route::is('module.contact.create') || Route::is('module.contact.edit') || Route::is('module.faq.category.index') || Route::is('module.faq.category.create') || Route::is('module.faq.category.edit') || Route::is('module.faq.index') || Route::is('module.faq.create') || Route::is('module.faq.edit') ? true : false"
                    :subLinkActive="Route::is('module.testimonial.index') || Route::is('module.testimonial.create') || Route::is('module.testimonial.edit') || Route::is('module.contact.index') || Route::is('module.contact.create') || Route::is('module.contact.edit') || Route::is('module.faq.category.index') || Route::is('module.faq.category.create') || Route::is('module.faq.category.edit') || Route::is('module.faq.index') || Route::is('module.faq.create') || Route::is('module.faq.edit') ? true : false"
                    icon="far fa-list-alt">
                    @slot('title')
                    {{ __('others') }}
                    @endslot

                    @if (Module::collections()->has('Testimonial') && userCan('testimonial.view') &&
                    $testimonial_enable)
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.testimonial.index') || Route::is('module.testimonial.create') || Route::is('module.testimonial.edit') ? true : false"
                            route="module.testimonial.index" icon="fas fa-circle">
                            {{ __('testimonial') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (Module::collections()->has('Contact') && userCan('contact.view') && $contact_enable)
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.contact.index') || Route::is('module.contact.create') || Route::is('module.contact.edit') ? true : false"
                            route="module.contact.index" icon="fas fa-circle">
                            {{ __('contact') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (userCan('faqcategory.view') && $faq_enable)
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.faq.category.index') || Route::is('module.faq.category.create') || Route::is('module.faq.category.edit') ? true : false"
                            route="module.faq.category.index" icon="fas fa-circle">
                            {{ __('faq_category') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (userCan('faq.view') && $faq_enable)
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('module.faq.index') || Route::is('module.faq.create') || Route::is('module.faq.edit') ? true : false"
                            route="module.faq.index" icon="fas fa-circle">
                            {{ __('faq') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                </x-sidebar-dropdown>
                @endif

                {{-- Admin --}}
                @if (userCan('admin.view') || userCan('role.view'))
                <x-sidebar-dropdown
                    :linkActive="Route::is('role.index') || Route::is('role.create') || Route::is('role.edit') || Route::is('user.index') || Route::is('user.create') || Route::is('user.edit') ? true : false"
                    :subLinkActive="Route::is('role.index') || Route::is('role.create') || Route::is('role.edit') || Route::is('user.index') || Route::is('user.create') || Route::is('user.edit') ? true : false"
                    icon="fas fa-lock">
                    @slot('title')
                    {{ __('user_role_manage') }}
                    @endslot

                    @if (userCan('admin.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('user.index') || Route::is('user.create') || Route::is('user.edit') ? true : false"
                            route="user.index" icon="fas fa-circle">
                            {{ __('all_users') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if (userCan('role.view'))
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('role.index') || Route::is('role.create') || Route::is('role.edit') ? true : false"
                            route="role.index" icon="fas fa-circle">
                            {{ __('all_roles') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                </x-sidebar-dropdown>
                @endif

                {{-- Setting --}}
                @if (userCan('setting.view'))
                <x-sidebar-dropdown
                    :linkActive="Route::is('language.index') || Route::is('language.create') || Route::is('language.edit') || Route::is('language.view') || Route::is('setting.index') || Route::is('module.themes.index') ? true : false"
                    :subLinkActive="Route::is('language.index') || Route::is('language.create') || Route::is('language.edit') || Route::is('language.view') || Route::is('setting.index') || Route::is('module.themes.index') ? true : false"
                    icon="fas fa-cog">
                    @slot('title')
                    {{ __('settings') }}
                    @endslot
                    @if ($appearance_enable)
                    <ul class="nav nav-treeview">
                        <x-sidebar-list :linkActive="Route::is('module.themes.index') ? true : false"
                            route="module.themes.index" icon="fas fa-circle">
                            {{ __('skins') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    @if ($language_enable)
                    <ul class="nav nav-treeview">
                        <x-sidebar-list
                            :linkActive="Route::is('language.index') || Route::is('language.create') || Route::is('language.edit') || Route::is('language.view') ? true : false"
                            route="language.index" icon="fas fa-circle">
                            {{ __('language') }}
                        </x-sidebar-list>
                    </ul>
                    @endif
                    <ul class="nav nav-treeview">
                        <x-sidebar-list :linkActive="Route::is('setting') ? true : false" route="setting"
                            parameter="website" icon="fas fa-circle">
                            {{ __('settings') }}
                        </x-sidebar-list>
                    </ul>
                </x-sidebar-dropdown>
                @endif
                <a href="{{ route('frontend.index') }}" target="_blank"
                    class="btn btn-primary mt-4 mx-3 text-white">{{ __('visit_website') }}</a>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
