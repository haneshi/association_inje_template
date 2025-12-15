@yield('php')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.head')
</head>
<body class="g-sidenav-show  bg-gray-100">
    @include('admin.layouts.aside')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid">
            @include('admin.layouts.header')
        </div>
        <div class="container-fluid py-4">
            @yield('mainContent')
        </div>
    </main>
    @include('admin.layouts.notification')
    @include('admin.layouts.script')
</body>
</html>
