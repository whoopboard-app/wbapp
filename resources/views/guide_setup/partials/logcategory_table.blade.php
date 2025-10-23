@if($categories->isEmpty())
    <tr>
        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
            No record found
        </td>
    </tr>
@else
    @foreach($categories as $category)
        <tr class="border-bottom">
            <!-- Status -->
            <td class="py-2">
                @php
                    $statusClasses = [
                        0 => 'status-inactive',    // Inactive
                        1 => 'status-active',  // Active
                        2 => 'status-draft' // Draft
                    ];
                    $statusLabels = [
                        0 => 'Inactive',
                        1 => 'Active',
                        2 => 'Draft'
                    ];
                @endphp
                <span class="badge fw-normal bg-white
                        {{ $category->status == '1' ? 'status-active' : ($category->status == '2' ? 'status-draft' : 'status-inactive') }}
                        rounded-pill border-1">
                        {{ $category->status == '1' ? 'Active' : ($category->status == '2' ? 'Draft' : 'Inactive') }}
                    </span>
            </td>
            <!-- Category Name -->
            <td class="py-2">{{ $category->category_name }}</td>

            <!-- Color Code -->
            <td class="py-2 flex items-center space-x-2">
                <span class="inline-block w-3 h-3 rounded-full" style="background: {{ $category->color_hex }};"></span>
                <span>{{ $category->color_hex }}</span>
            </td>

            <!-- Action Dropdown -->
            <td>
                <div class="d-flex align-items-center sm justify-content-start gap-2 action-icons-wrapper">
                    <!-- Edit -->
                    <a href="{{ route('categories.edit', $category->id) }}">
                        <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit" class="action-icon">
                    </a>

                    <div class="divider"></div>

                    <!-- View / Status -->
                    <a href="javascript:void(0)"
                       class="view-category"
                       data-id="{{ $category->id }}">
                        <img src="{{ asset('assets/img/icon/oval.svg') }}" alt="oval" class="action-icon">
                    </a>

                    <div class="divider"></div>

                    <!-- Delete -->
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="m-0 p-0 d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-transparent p-0">
                            <img src="{{ asset('assets/img/icon/trash.svg') }}" alt="trash" class="action-icon">
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
@endif
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const searchInput = document.querySelector('input[name="search"]');
        const tableBody = document.getElementById('tag-table-body');

        let timeout = null;

        function fetchCategories(url) {
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    tableBody.innerHTML = html;

                    // Re-bind pagination links after reload
                    bindPaginationLinks();
                });
        }

        function bindPaginationLinks() {
            tableBody.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    fetchCategories(this.href);
                });
            });
        }

        // Debounced search
        searchInput.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const url = `{{ route('guide.setup.changelog.category') }}?search=${encodeURIComponent(this.value)}`;
                fetchCategories(url);
            }, 300);
        });

        // Initial binding
        bindPaginationLinks();
    });
</script>

