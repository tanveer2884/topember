@extends('frontend.layouts.master')

@section('meta_title', $page->title)
@section('meta_description', $page->short_description)

@push('page_css')
    <style>
        {!! $page->css !!}
    </style>
@endpush

@section('page')
    {!! $page->html !!}
@endsection



