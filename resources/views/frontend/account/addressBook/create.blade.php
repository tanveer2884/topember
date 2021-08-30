@extends('frontend.account.layouts.my-account')

@section('meta_title', 'Create Address')
@section('meta_description', 'Create New Address')

@section('account-page')

    <div class="profile-main">
        <div class="account-head">
            <h1>Add New Address</h1>
        </div>
        <div class="profile-description">
            <livewire:frontend.account.address.create-edit-address />
        </div>
    </div>

@endsection
