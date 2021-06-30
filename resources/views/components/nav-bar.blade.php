<nav class="no-print header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-header d-none d-sm-block">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item">
                <a class="navbar-brand" href="/">
                    <div class="brand-logo px-1 h6">
{{--                        <i class="fa fa-globe"></i> Date & Time: {{ \Carbon\Carbon::now()->timezone(auth()->user()->getTimezone())->format('m-d-Y g:i:s a') }}--}}
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ficon feather icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <ul class="nav navbar-nav float-right">
{{--                    <x-lang-switcher></x-lang-switcher>--}}
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-expand">
                            <i class="ficon feather icon-maximize"></i>
                        </a>
                    </li>

                    {{--<x-web-search></x-web-search>--}}
                    {{--Notification--}}
                    {{--<x-notification></x-notification>--}}
                    <x-user-profile></x-user-profile>
                </ul>
            </div>
        </div>
    </div>
</nav>
