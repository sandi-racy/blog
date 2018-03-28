@if ($paginator->hasPages())
    <nav class="blog-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-outline-primary" href="{{ $paginator->nextPageUrl() }}" rel="prev">Older</a>
        @else
            <a class="btn btn-outline-secondary disabled">Older</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn btn-outline-secondary disabled">Newer</a>
        @else
            <a class="btn btn-outline-primary" href="{{ $paginator->previousPageUrl() }}" rel="next">Newer</a>
        @endif
    </nav>
@endif