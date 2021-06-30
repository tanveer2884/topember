<li class="dropdown dropdown-user nav-item">
    <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
        <div class="user-nav d-sm-flex d-none">
            <span class="user-name text-bold-600">
                {{ auth()->user()->name }}
            </span>
            <span class="user-status">Available</span>
        </div>
        <span>
            <img class="round" src="{{ auth()->user()->getImage() }}" alt="avatar" height="40" width="40">
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{ Route::has(config('app.adminRouteNamePrefix').'profile.index') ? route(config('app.adminRouteNamePrefix').'profile.index') : '' }}">
            <i class="feather icon-user"></i> Edit Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" onclick="$('#logoutForm').submit()">
            <i class="feather icon-power"></i> Logout
        </a>
        <form action="{{ route('logout') }}" method="post" id="logoutForm">
            @csrf
        </form>
    </div>
</li>
