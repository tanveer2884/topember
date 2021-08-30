@extends('frontend.account.layouts.my-account')

@section('meta_title', 'Edit Address')
@section('meta_description', 'Edit Address')

@section('account-page')

    <div class="profile-main">
        <div class="account-head">
            <h1>Edit Address</h1>
        </div>
        <div class="profile-description">
            <livewire:frontend.account.address.create-edit-address :address="$address" />
        </div>
    </div>


@endsection
