@if ($paginator->hasPages())
    <ul class="pagination m-0">
        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $perGroup = 10; // 한 그룹당 10개씩
            $currentGroup = ceil($current / $perGroup);
            $start = ($currentGroup - 1) * $perGroup + 1;
            $end = min($start + $perGroup - 1, $last);
        @endphp

        {{-- 이전 그룹 버튼 --}}
        @if ($currentGroup > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($start - 1) }}" tabindex="-1">
                    <x-tabler-chevron-left class="icon" />
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">
                    <x-tabler-chevron-left class="icon" />
                </a>
            </li>
        @endif

        {{-- 페이지 번호들 (1~10, 11~20 형식) --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $current)
                <li class="page-item active">
                    <a class="page-link">{{ $page }}</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                </li>
            @endif
        @endfor

        {{-- 다음 그룹 버튼 --}}
        @if ($end < $last)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($end + 1) }}" tabindex="-1">
                    <x-tabler-chevron-right class="icon" />
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">
                    <x-tabler-chevron-right class="icon" />
                </a>
            </li>
        @endif
    </ul>
@endif
