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
                        'inactive' => 'status-inactive',
                        'active'   => 'status-active',
                        'draft'    => 'status-draft',
                        'schedule' => 'status-schedule',
                    ];

                    $statusLabels = [
                        'inactive' => 'Inactive',
                        'active'   => 'Active',
                        'draft'    => 'Draft',
                        'schedule' => 'Scheduled',
                    ];

                    $status = strtolower($category->status); // make sure it's lowercase
                    $badgeClass = $statusClasses[$status] ?? 'status-inactive';
                    $badgeLabel = $statusLabels[$status] ?? ucfirst($status);
                @endphp

                <span class="badge fw-normal bg-white {{ $badgeClass }} rounded-pill border-1">
        {{ $badgeLabel }}
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
                <div class="icon-box d-flex align-items-center gap-2">
                    <!-- Edit -->
                    <a href="{{ route('categories.edit', $category->id) }}">
                        <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit" style="max-width:15px;">
                    </a>

                    <div class="divider"></div>

                    <!-- View -->
                    <a href="javascript:void(0)"
                       class="view-member"
                       data-id="{{ $category->id }}">
                        <img src="{{ asset('assets/img/icon/oval.svg') }}" alt="View" style="max-width:15px;">
                    </a>

                    <div class="divider"></div>

                    <!-- Delete -->
                    <a href="javascript:void(0)">
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="m-0 p-0 d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this Category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-0 bg-transparent p-0">
                                <img src="{{ asset('assets/img/icon/trash.svg') }}" alt="trash" class="action-icon">
                            </button>
                        </form>
                    </a>
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

