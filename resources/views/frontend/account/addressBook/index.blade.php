@extends('frontend.account.layouts.my-account')

@section('meta_title', 'Address')
@section('meta_description', '')

@section('account-page')

    <div class="profile-main">
        <div class="account-head">
            <h1>Address Book</h1>
        </div>
        <div class="profile-description">
            <p>Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here Sample Text Here.</p>
            <a href="{{ route('user.addresses.create') }}" class="general-btn">Add New Address</a>
            <livewire:frontend.account.address.list-address />

        </div>
    </div>

@endsection
