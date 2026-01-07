@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '특산물',
        'name' => '특산물 추가',
    ];
@endphp

@section('title', "| {$pageData['title']}")

@section('beforeStyle')
    <link rel="stylesheet" href="{{ asset('assets/plugins/uppy/uppy.min.css') }}?v={{ env('SITES_ADMIN_ASSETS_VERSION') }}">
@endsection

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    @include('admin.pages.special.partials.form.write')
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
