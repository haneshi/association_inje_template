<!DOCTYPE html>
<html lang="ko">

<head>
    @php
        $pageData = [
            'title' => '로그인',
            'pageTitle' => '관리자 계정 로그인',
        ];
    @endphp
    @section('title', "| {$pageData['title']}")
    @include('admin.layouts.head')
</head>
<body>
    {{-- 기존 HTML 구조와 달라서 로그인 페이지는 예외적으로 HTML 만듦 --}}
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav
                    class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
                            {{ $pageData['pageTitle'] }}
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            @include('admin.pages.auth.components.main')
        </section>
    </main>
    @include('admin.layouts.notification')
    @include('admin.layouts.script')
</body>

</html>
