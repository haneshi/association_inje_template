@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => '게시판',
        'name' => $board->board_name . ' 게시판',
    ];
@endphp

@section('title', "| {$pageData['title']}")

{{-- @section('beforeStyle')@endsection --}}

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    @include('admin.pages.board.faq.partials.list')
    faq index
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
