<div class="account-list">
    <h2>My Account</h2>
    <ul>
        <li><a href="{{route('user.my-account')}}" class="active">My Profile</a></li>
        <li><a href="{{route('user.addresses.index')}}">Address Book</a></li>
        <li><a href="javascript:void(0);">Payments</a></li>
        <li><a href="javascript:void(0);">My Orders</a></li>
        <li><a href="javascript:void(0);">View Scanned Mail</a></li>
        <li><a href="javascript:void(0);">Change Password</a></li>
        <li><a href="javascript:void(0);" onclick="$('#logoutForm').submit()">Logout</a></li>
        <form action="{{ route('user.logout') }}" method="post" id="logoutForm">
            @csrf
        </form>
    </ul>
</div>
