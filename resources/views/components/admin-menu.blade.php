<div class="no-print main-menu menu-fixed menu-light menu-accordion menu-shadow menu-collapsed" data-scroll-to-active="true" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="navbar-header expanded">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto d-flex align-items-center">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/admin/logo.png') }}" class="ml-2" style="height: 50px;width: 141px;" alt="">
                </a>
            </li>
            <li class="nav-item nav-toggle d-flex align-items-center">
                <a class="nav-link modern-nav-toggle pr-0 shepherd-modal-target" data-toggle="collapse">
                    <i class="icon-x d-block d-xl-none font-medium-4 primary toggle-icon feather icon-disc"></i>
                    <i class="toggle-icon icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary feather" data-ticon="icon-disc" tabindex="0"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content pt-2 ps ps--active-y">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ $isActive('admin.dashboard.index') }}">
                <a href="{{ route('admin.dashboard.index') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'pages.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'pages.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'pages.index') }}">
                        <i class="feather icon-file"></i>
                        <span class="menu-title">Pages</span>
                    </a>
                </li>
            @endif

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'menus.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'menus.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'menus.index') }}">
                        <i class="feather icon-list"></i>
                        <span class="menu-title">Menus</span>
                    </a>
                </li>
            @endif

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'categories.index'))
                <li class="nav-item {{ $isActive([config('app.adminRouteNamePrefix') . 'categories.index', config('app.adminRouteNamePrefix') . 'categories.create', config('app.adminRouteNamePrefix') . 'categories.edit']) }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'categories.index') }}">
                        <i class="fa fa-th-large"></i>
                        <span class="menu-title">Categories</span>
                    </a>
                </li>
            @endif

            <li class="nav-item has-sub sidebar-group">
                <a href="#" title="Forum">
                    <i class="feather icon-folder"></i>
                    <span class="menu-title">Catalog</span>
                </a>
                <ul class="menu-content">
                    @if (hasRoute(config('app.adminRouteNamePrefix') . 'products.index'))
                        <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'products.index') }}">
                            <a href="{{ route(config('app.adminRouteNamePrefix') . 'products.index') }}">
                                <i class="feather icon-package"></i>
                                <span class="menu-title">Products</span>
                            </a>
                        </li>
                    @endif

                        @if (hasRoute(config('app.adminRouteNamePrefix') . 'manufacturers.index'))
                            <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'manufacturers.index') }}">
                                <a href="{{ route(config('app.adminRouteNamePrefix') . 'manufacturers.index') }}">
                                    <i class="feather icon-package"></i>
                                    <span class="menu-title">Manufacturers</span>
                                </a>
                            </li>
                        @endif

                    @if (hasRoute(config('app.adminRouteNamePrefix') . 'attributes.index'))
                        <li class="nav-item {{ $isActive([config('app.adminRouteNamePrefix') . 'attributes.index', config('app.adminRouteNamePrefix') . 'attributes.create', config('app.adminRouteNamePrefix') . 'attributes.edit']) }}">
                            <a href="{{ route(config('app.adminRouteNamePrefix') . 'attributes.index') }}">
                                <i class="feather icon-tag"></i>
                                <span class="menu-title">Attributes</span>
                            </a>
                        </li>
                    @endif

                    @if (hasRoute(config('app.adminRouteNamePrefix') . 'coupons.index'))
                        <li class="nav-item {{ $isActive([config('app.adminRouteNamePrefix') . 'coupons.index', config('app.adminRouteNamePrefix') . 'coupons.create', config('app.adminRouteNamePrefix') . 'coupons.edit']) }}">
                            <a href="{{ route(config('app.adminRouteNamePrefix') . 'coupons.index') }}">
                                <i class="feather icon-tag"></i>
                                <span class="menu-title">Coupons</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </li>


            @if (hasRoute(config('app.adminRouteNamePrefix') . 'orders.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'orders.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'orders.index') }}">
                        <i class="feather icon-dollar-sign"></i>
                        <span class="menu-title">Orders</span>
                    </a>
                </li>
            @endif

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'faqs.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'faqs.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'faqs.index') }}">
                        <i class="fa fa-question-circle-o"></i>
                        <span class="menu-title">Faqs</span>
                    </a>
                </li>
            @endif

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'testimonials.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'testimonials.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'testimonials.index') }}">
                        <i class="fa fa-quote-left"></i>
                        <span class="menu-title">Testimonials</span>
                    </a>
                </li>
            @endif

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'users.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'users.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'users.index') }}">
                        <i class="feather icon-users"></i>
                        <span class="menu-title">Users</span>
                    </a>
                </li>
            @endif

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'roles.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'roles.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'roles.index') }}">
                        <i class="fa fa-key"></i>
                        <span class="menu-title">Roles</span>
                    </a>
                </li>
            @endif

            @if (hasRoute(config('app.adminRouteNamePrefix') . 'settings.index'))
                <li class="nav-item {{ $isActive(config('app.adminRouteNamePrefix') . 'settings.index') }}">
                    <a href="{{ route(config('app.adminRouteNamePrefix') . 'settings.index') }}">
                        <i class="feather icon-settings"></i>
                        <span class="menu-title">Setting</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
