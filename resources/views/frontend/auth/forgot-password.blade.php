@extends('frontend.layouts.master')

@section('title','Forgot Password')
@section('description','Reset Your password here')


@section('page')

<div class="container-fluid">
    <div class="reset-password-page">
        <div class="container">
            <div class="reset-password-main">
                <div class="row">
                    <div class="col-12">
                        <div class="reset-password-heading">
                            <h2>RESET PASSWORD</h2>
                        </div>
                        <div class="under-line"></div>
                    </div>
                    <div class="col-12">
                        <div class="reset-password-para">
                            <p>If you need help with logging in your account please call customer service at {{ getGeneralSetting('store_contact_phone') }}</p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="reset-form">
                            <livewire:frontend.auth.forgot-password-controller />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
