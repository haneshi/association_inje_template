@yield('beforeScript')
<script src="{{ asset('assets/admin/js/common.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apps/js/apps.min.js') }}"></script>
<script src="{{ asset('assets/plugins/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/js/soft-ui-dashboard.min.js') }}"></script>
@if (Session::has('flash_error'))
    <script>
        @if (Session::has('flash_error_toast') && Session::get('flash_error_toast'))
            apps.layouts.showToastTemplate({
                'title': "{{ Session::get('flash_error')['title'] ?? '' }}",
                'content': "{{ Session::get('flash_error')['content'] ?? '' }}",
                'delay': 2000,
            });
        @else
            apps.layouts.showModalTemplate({
                icon: true,
                title: "{{ Session::get('flash_error')['title'] ?? '' }}",
                content: "{{ Session::get('flash_error')['content'] ?? '' }}",
            });
        @endif
    </script>
@endif
@yield('afterScript')
