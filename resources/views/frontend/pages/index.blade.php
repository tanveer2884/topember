@extends('frontend.layouts.master')

@section('meta_title',$page->meta_title)
@section('meta_description',$page->meta_description)

@push('page_css')
    <style>
        {!! $page->getCss() !!}
    </style>
@endpush

@section('page')
    {!! $page->getHtml() !!}
@endsection