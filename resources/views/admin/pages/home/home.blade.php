@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '관리자 홈',
        'pageTitle' => '관리자 대시보드',
    ];
@endphp

@section('title', "| {$pageData['title']}")

{{-- @section('beforeStyle')@endsection --}}

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    <div class="text-align-center">
        메인 컨텐츠
    </div>
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}

