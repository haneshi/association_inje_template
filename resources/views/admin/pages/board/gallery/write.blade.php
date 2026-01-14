@extends('admin.layouts.default.layout')


@php
    $pageData = [
        'title' => $board->board_name . ' 게시글',
        'name' => $board->board_name . ' 게시판',
    ];
@endphp

@section('title', "| {$pageData['title']}")

{{-- @section('beforeStyle')@endsection --}}

{{-- @section('afterStyle')@endsection --}}

@section('mainContent')
    @include('admin.pages.board.' . $board->type . '.partials.form.write')
@endsection

{{-- @section('beforeScript')@endsection --}}
{{-- @section('afterScript') @endsection --}}
