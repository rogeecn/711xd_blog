@if ($paginator->hasPages())
    <ul class="pagination justify-content-between" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link rounded">上一页</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link rounded" href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link rounded" href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link rounded">下一页</span>
            </li>
        @endif
    </ul>
@endif
