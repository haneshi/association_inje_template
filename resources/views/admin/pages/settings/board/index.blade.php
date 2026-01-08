@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '관리자',
        'name' => '게시판 관리',
    ];
@endphp

@section('title', "| {$pageData['title']}")

{{-- @section('beforeStyle')@endsection --}}

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    @include('admin.pages.settings.board.partials.list')
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
