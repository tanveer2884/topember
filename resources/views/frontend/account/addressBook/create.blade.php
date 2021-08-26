@extends('frontend.layouts.master')

@section('meta_title','Create Address')
@section('meta_description','Create New Address')

@section('page')

    <div class="inner-section">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="account-main">
                            <div class="row">
                                <div class="col-md-4">
                                    @include('frontend.account.layouts.account-menu')
                                </div>
                                    <div class="col-md-8">
                                        <div class="profile-main">
                                            <div class="account-head">
                                                <h1>Add New Address</h1>
                                            </div>
                                            <livewire:frontend.account.address.create-edit-address :_address="$address" />
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
