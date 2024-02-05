<header class="header-wrap @yield('header_classes')">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar">
                    <a href="{{ route('homepage') }}" class="navbar-brand">
                        @if ($logo_full = config('custom.logo_full'))
                            <img src="{!! $logo_full !!}" height="36px" class="w-48 img img-responsive"
                                alt="logo">
                        @else
                            <img src="/frontend/images/logo.png" height="36px" class="w-48 img img-responsive"
                                alt="logo">
                        @endif
                    </a>

                    <div class="navbar mob-nav">
                        <ul class="nav-menu">
                            @foreach (get_menu('header') as $item)
                            <li class="nav-item">
                                <a class="nav-link" target="{{ $item->target }}"
                                    href="{{ $item->link }}">{{ $item->title }}
                                    @if($item->children->count() > 0)
                                        <span><i class="fas fa-caret-down main-caret"></i></span>
                                    @endif
                                </a>
                                @if($item->children->count() > 0)
                                <ul>
                                    @foreach ($item->children as $subMenu)
                                        @if (empty($subMenu->children))
                                            <li>
                                                <a href="{{ $subMenu->link }}"
                                                    target="{{ $subMenu->target }}">{{ $subMenu->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        @endforeach
                            <div class="header-btn d-flex align-items-center">
                                <a class="contact-btn" href="{{ route('page', 'contact-us') }}">contact us</a>
                            </div>
                        </ul>
                    </div>

                    <div class="hamburger">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
