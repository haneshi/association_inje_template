@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '관리자 추가',
        'name' => '관리자 추가',
    ];
@endphp

@section('title', "| {$pageData['title']}")

{{-- @section('beforeStyle')@endsection --}}

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    @include('admin.pages.settings.manager.partials.form.write')
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}

