@extends('frontend.layouts.master')

@section('meta_title','Change Password')
@section('meta_description','')

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
                                            <h1>Change Password</h1>
                                        </div>
                                        <div class="profile-description">
                                            <p>Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here.</p>

                                            <div class="account-form">
                                                <livewire:frontend.account.update-password-form />
                                            </div>
                                        </div>
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
