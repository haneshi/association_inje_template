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
    @include('admin.pages.board.' . $board->type . '.partials.form.edit')
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
