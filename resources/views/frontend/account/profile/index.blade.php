@extends('frontend.account.layouts.my-account')

@section('meta_title','My Profile')
@section('meta_description','')

@section('page-section')

<div class="div-float acc-right">
    <div class="row mx-0 acc-right-header">
        <div class="col-12 px-0">
            <h2>My Profile</h2>
        </div>
    </div>
    <div class="row mx-0 acc-right-bottom">
        <div class="col-12 px-0">
            <div class="div-float acc-rb-inner">
                <div class="div-float profile-form gnrl-form">
                    <livewire:frontend.account.my-account-form />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
