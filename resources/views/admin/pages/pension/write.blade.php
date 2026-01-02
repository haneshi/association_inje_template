@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '펜션 추가',
        'name' => '펜션 추가',
    ];
@endphp

@section('title', "| {$pageData['title']}")

{{-- @section('beforeStyle')@endsection --}}

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    @include('admin.pages.pension.partials.form.pensionWrite')
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
