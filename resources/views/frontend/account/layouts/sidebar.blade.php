<div class="col-md-4">
    <div class="div-float acc-left">
        <div class="div-float acc-left-inner">
            <div class="div-float acc-nav">

                <h2>My Account</h2>
                <a href="#demo" class="acc-nav-toggle" data-toggle="collapse">My Account <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <div id="demo" class="collapse div-float nav-pannel">
                    <ul>
                        <li><a href="{{ route('user.my-account') }}" class="{{isActive(['user.my-account'])}}">My Profile</a></li>
                        {{-- <li><a href="{{ route('user.addresses.index') }}" class="{{isActive(['user.addresses.index'])}}">Address Book</a></li>
                        <li><a href="{{ route('user.payments.index') }}" class="{{isActive(['user.payments.index'])}}">Payments</a></li>
                        <li><a href="{{ route('user.orders.index') }}" class="{{isActive(['user.orders.index'])}}">My Orders</a></li> --}}
                        <li><a href="{{ route('user.update-password') }}" class="{{isActive(['user.update-password'])}}">Change Password</a></li>
                    </ul>
                </div>

            </div>
            <aside class="need-help div-float">
                <h3>Need Help?</h3>
                <p>If you have any questions or need help with your account, <a href="mailto:{{ getGeneralSetting('store_contact_email') }}">{{ getGeneralSetting('store_contact_email') }}</a>.</p>
            </aside>
        </div>
    </div>
</div>
