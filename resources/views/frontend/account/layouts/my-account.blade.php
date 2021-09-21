@extends('frontend.layouts.master')


@section('page')

    <div class="inner-section">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="account-main">
                            <div class="row">
                                <div class="col-md-4">
                                    @include('frontend.account.layouts.sidebar')
                                </div>

                                <div class="col-md-8">
                                    @yield('account-page')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
@endsection
