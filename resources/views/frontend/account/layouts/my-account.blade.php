@extends('frontend.layouts.master')


@section('page')

<div class="inner-pg-wrap">

    <div class="acc-portal-wrap">

        <div class="acc-header">
            <div class="custom-container">
                <div class="acc-header-in">
                    <h1>My Account</h1>
                    <p>
                        Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here
                    </p>
                </div>
            </div>
        </div>

        <div class="acc-bottom-wrap">
            <div class="custom-container">
                <div class="acc-bottom-inner">

                    <div class="row">

                        @include('frontend.account.layouts.sidebar')

                        <div class="col-md-8">
                            @yield('page-section')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
