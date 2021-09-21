@extends('frontend.account.layouts.my-account')

@section('meta_title', 'My Profile')
@section('meta_description', '')

@section('account-page')

    <div class="profile-main">
        <div class="account-head">
            <h1>My Profile</h1>
        </div>
        <div class="profile-description">
            <p>Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here.</p>

            <div class="account-form">
                <livewire:frontend.account.my-account-form />
            </div>
        </div>
    </div>

@endsection
