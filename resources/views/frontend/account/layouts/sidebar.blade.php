<div class="account-list">
    <h2>My Account</h2>
    <ul>
        <li><a href="{{ route('user.my-account') }}" class="{{ isActive(['user.my-account']) }}">My Profile</a></li>
        <li><a href="{{ route('user.addresses.index') }}" class="{{ isActive(['user.addresses.index']) }} {{ isActive(['user.addresses.create']) }} {{ isActive(['user.addresses.edit']) }}">Address Book</a></li>
        {{-- <li><a href="{{ route('user.payments.index') }}" class="{{ isActive(['user.payments.index']) }}">Payments</a></li> --}}
        <li><a href="{{ route('user.orders.index') }}" class="{{ isActive(['user.orders.index']) }} {{ isActive(['user.orders.show']) }}">My Orders</a></li>
        {{-- <li><a href="javascript:void(0);">View Scanned Mail</a></li> --}}
        <li><a href="{{ route('user.update-password') }}" class="{{ isActive(['user.update-password']) }}">Change Password</a></li>
        <li><a href="javascript:void(0);" onclick="$('#logoutForm').submit()">Logout</a></li>
        <form action="{{ route('user.logout') }}" method="post" id="logoutForm">
            @csrf
        </form>
    </ul>
</div>
