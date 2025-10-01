@php
    $collapseId = 'collapseCategory' . $category->id;
@endphp

<div class="{{ $level === 0 ? 'card mb-2 rounded border bg-white' : 'mb-2 ps-3' }}">
    <!-- Category Header -->
    <div class="card-header d-flex justify-content-between align-items-center board-clickable
                {{ $level === 0 ? 'rounded border-0' : 'border-0 ps-0 bg-transparent' }}"
         style="cursor: pointer;"
         onclick="toggleCategory('{{ $collapseId }}', event)">
        <div class="d-flex align-items-center">
            @if($category->children && $category->children->count())
                <i id="arrow-{{ $collapseId }}"
                   class="fa fa-chevron-right me-2 text-muted"
                   style="transition: transform 0.3s;"></i>
            @else
                <span class="me-2"></span>
            @endif

            <span class="fw-semibold">{{ $category->name }}</span>

            @php
                $totalCount = $category->totalArticlesCount();
            @endphp

            @if($totalCount > 0)
                <span class="badge bg-primary ms-2">Total Articles {{ $totalCount }}</span>
            @else
                <span class="text-muted small ms-2">No articles yet</span>
            @endif

            @if($category->articles && $category->articles->count())
                <span class="badge bg-primary ms-2">{{ $category->articles->count() }} Associated Articles</span>
            @endif
        </div>

        @if($totalCount > 0)
            <a href="{{ route('kbcategory.articles', ['category' => $category->id]) }}"
               class="btn btn-sm btn-outline-primary d-flex align-items-center"
               onclick="event.stopPropagation()">
                <i class="fa fa-eye me-1"></i> View Articles
            </a>
        @endif
    </div>

    <!-- Child Categories -->
    @if($category->children && $category->children->count())
        <div class="child-collapse" id="{{ $collapseId }}" style="display: none;">
            <div class="card-body ps-4 {{ $level === 0 ? '' : 'pt-1 pb-1 ps-3' }}">
                @foreach($category->children as $child)
                    @include('kbarticle.partials.category_tree', ['category' => $child, 'level' => $level + 1])
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    function toggleCategory(collapseId, event) {
        if (event.target.closest('.dropdown') || event.target.tagName === 'A') return;

        const el = document.getElementById(collapseId);
        const arrow = document.getElementById('arrow-' + collapseId);

        if (el.style.display === 'none' || el.style.display === '') {
            // Expand
            el.style.display = 'block';
            el.style.height = '0px';
            const fullHeight = el.scrollHeight + 'px';
            el.style.transition = 'height 0.3s ease';
            setTimeout(() => el.style.height = fullHeight, 10);

            // Rotate arrow
            if (arrow) arrow.style.transform = 'rotate(90deg)';

            el.addEventListener('transitionend', function handler() {
                el.style.height = 'auto';
                el.removeEventListener('transitionend', handler);
            });
        } else {
            // Collapse
            el.style.height = el.scrollHeight + 'px';
            setTimeout(() => el.style.height = '0px', 10);

            // Rotate arrow back
            if (arrow) arrow.style.transform = 'rotate(0deg)';

            el.addEventListener('transitionend', function handler() {
                el.style.display = 'none';
                el.removeEventListener('transitionend', handler);
            });
        }
    }
</script>

