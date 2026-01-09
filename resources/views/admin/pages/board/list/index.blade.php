@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '게시판',
        'name' => '게시판',
    ];
@endphp

@section('title', "| {$pageData['title']}")

{{-- @section('beforeStyle')@endsection --}}

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    {{-- @include('admin.pages. .partials.list') --}}
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
