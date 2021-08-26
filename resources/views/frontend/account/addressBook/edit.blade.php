@extends('frontend.account.layouts.my-account')

@section('meta_title','Edit Address')
@section('meta_description','Edit Address')

@section('page-section')

<div class="div-float acc-right">

    <div class="row mx-0 acc-right-header">
        <div class="col-12 px-0">
            <h2>Edit Address </h2>
        </div>
    </div>

    <div class="row mx-0 acc-right-bottom">
        <div class="col-12 px-0">
            <div class="div-float acc-rb-inner">

                <div class="div-float profile-form gnrl-form add-address">
                    <livewire:frontend.account.address.create-edit-address :address="$address" />
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
