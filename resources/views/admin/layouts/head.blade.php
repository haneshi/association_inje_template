<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ env('SITES_ADMIN_SITE_NAME') }} @yield('title')</title>

<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/plugins/img/apple-icon.png') }}">
<link rel="icon" type="image/png" href="{{ asset('assets/plugins/img/favicon.png') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
<!-- Nucleo Icons -->
<link rel="stylesheet" href="{{ asset('assets/plugins/css/nucleo-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/css/nucleo-svg.css') }}" />
<!-- Font Awesome Icons 폰트어썸은 테이블러 아이콘으로 대체할 예정 -->
{{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
<!-- CSS Files -->
@yield('beforeStyle')
<link rel="stylesheet" href="{{ asset('assets/plugins/css/soft-ui-dashboard.min.css?v=1.1.0') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/apps/css/custom.min.css') }}">
@yield('afterStyle')
