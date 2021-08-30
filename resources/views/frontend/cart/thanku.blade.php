@extends('frontend.layouts.master')

@section('title', 'Thank You')
@section('description', '')

@section('page')

    <div class="thank-you-wrapper" style="background-image:url('images/thanks-banner.png');">
        <div class="thanks-alert-wrapper">
            <h2 class="thanks-heading">Thank You</h2>
            <p class="thanks-para-bold">
                We received your order AUK 12345678<br>
                and it is in process.
            </p>
            <p class="thanks-para-light">
                Lorem ipsum dolor sit amet, consec tetuer adipiscing elit,
                sed diam nibh euismod tincidunt ut laoreet dolore magna aliquam
                erat volutpat. ipsum dolor sit amet, consec tetuer adipiscing elit,
            </p>
            <!-- <div class="sign-in-side-butn">
                <a href="track-package.php" class="sign-in-butn general-btn">Track</a>
            </div> -->
        </div>
    </div>

@endsection
