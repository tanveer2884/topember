@extends('frontend.layouts.master')

@section('title', $page->meta_title)
@section('description', $page->meta_description)

@push('page_css')
<style>
    {!! $page->getCss() !!}

</style>
@endpush

@section('page')
{!! $page->getHtml() !!}
@endsection

@if ($page->id == 1)
    @push('page_css')
        <link rel="stylesheet" href="{{ asset('/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/slick.css') }}">
    @endpush
    @push('page_js')
        @include('frontend.layouts.homepagejs')
    @endpush
@endif
