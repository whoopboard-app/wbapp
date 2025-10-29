@if(isset($paginator) && $paginator->hasPages())
<div class="d-flex align-items-center gap-3 p-3 pagination bg-white border">
        <a href="#"
           class="fw-semibold prev text-dark rounded sm {{ $paginator->onFirstPage() ? 'disabled text-muted' : '' }}"
           data-page="{{ $paginator->onFirstPage() ? 1 : $paginator->currentPage() - 1 }}"
           style="{{ $paginator->onFirstPage() ? 'pointer-events:none; opacity:0.6;' : '' }}">
            &lt; Previous
        </a>
    <div class="page-numbers d-flex align-items-center gap-2">
        @for($i = 1; $i <= $paginator->lastPage(); $i++)
            <a href="#" class="pagination-number {{ $paginator->currentPage() == $i ? 'active' : '' }}" data-page="{{ $i }}">
                {{ $i }}
            </a>
        @endfor
    </div>

            <a href="#"
               class="next fw-semibold rounded sm {{ !$paginator->hasMorePages() ? 'disabled text-muted' : '' }}"
               data-page="{{ !$paginator->hasMorePages() ? $paginator->currentPage() : $paginator->currentPage() + 1 }}"
               style="{{ !$paginator->hasMorePages() ? 'pointer-events:none; opacity:0.6;' : '' }}">
                Next &gt;
            </a>
        @endif
</div>
