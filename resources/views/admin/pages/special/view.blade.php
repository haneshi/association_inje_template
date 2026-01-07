@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '특산물',
        'name' => $special->name . ' 상세보기',
    ];
@endphp

@section('title', "| {$pageData['title']}")

@section('beforeStyle')
    <link rel="stylesheet" href="{{ asset('assets/plugins/uppy/uppy.min.css') }}?v={{ env('SITES_ADMIN_ASSETS_VERSION') }}">
@endsection

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    @include('admin.pages.special.partials.form.edit')
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
