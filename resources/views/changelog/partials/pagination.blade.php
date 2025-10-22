<div class="d-flex align-items-center gap-3 p-3 pagination bg-white border-bottom">
    @if($announcements->currentPage() > 1)
        <a href="#" class="fw-semibold prev text-dark rounded sm" data-page="{{ $announcements->currentPage() - 1 }}">
            &lt; Previous
        </a>
    @endif

    <div class="page-numbers d-flex align-items-center gap-2">
        @for($i = 1; $i <= $announcements->lastPage(); $i++)
            <a href="#" class="pagination-number {{ $announcements->currentPage() == $i ? 'active' : '' }}" data-page="{{ $i }}">
                {{ $i }}
            </a>
        @endfor
    </div>

    @if($announcements->currentPage() < $announcements->lastPage())
        <a href="#" class="next fw-semibold rounded sm" data-page="{{ $announcements->currentPage() + 1 }}">
            Next &gt;
        </a>
    @endif
</div>
