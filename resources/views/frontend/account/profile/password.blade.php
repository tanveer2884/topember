@extends('frontend.account.layouts.my-account')

@section('meta_title','Change Password')
@section('meta_description','')

@section('page-section')

<div class="div-float acc-right">
    <div class="row mx-0 acc-right-header">
        <div class="col-12 px-0">
            <h2>Change Password</h2>
        </div>
    </div>
    <div class="row mx-0 acc-right-bottom">
        <div class="col-12 px-0">
            <div class="div-float acc-rb-inner">

                <div class="div-float profile-form gnrl-form change-pass-wrap">
                    <livewire:frontend.account.update-password-form />
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
