@php
    $collapseId = 'collapseCategory' . $category->id;
@endphp

<div class="card mb-2" style="background: white">
    <!-- Make the header clickable -->
    <div class="card-header d-flex justify-content-between align-items-center rounded border-0 board-clickable"
         style="cursor: pointer;"
         onclick="toggleCollapse('{{ $collapseId }}', event)">
    <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-1">{{ $category->name }}</h5>
                @if($category->articles && $category->articles->count())
                    <span class="badge bg-primary">{{ $category->articles->count() }} Articles</span>
                @else
                    <span class="text-muted small">No articles yet</span>
                @endif
            </div>
        </div>

        @if($category->articles && $category->articles->count())
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton{{ $category->id }}"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        onclick="event.stopPropagation();">
                    View Articles
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $category->id }}">
                    @foreach($category->articles as $article)
                        <li><a class="dropdown-item" href="#">{{ $article->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @if($category->children && $category->children->count())
        <div class="collapse" id="{{ $collapseId }}">
            <div class="card-body ps-4">
                @foreach($category->children as $child)
                    @include('kbarticle.partials.category_tree', ['category' => $child, 'level' => $level + 1])
                @endforeach
            </div>
        </div>
    @endif
</div>
<script>
    function toggleCollapse(collapseId, event) {
        // Prevent toggling if dropdown or link inside clicked
        if (event.target.closest('.dropdown') || event.target.tagName === 'A') return;

        const collapseEl = document.getElementById(collapseId);
        const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapseEl);
        bsCollapse.toggle();
    }
</script>
