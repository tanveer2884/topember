@extends('frontend.account.layouts.my-account')

@section('meta_title', 'Change Password')
@section('meta_description', '')

@section('account-page')

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
    
@endsection
