@if($categories->isEmpty())
    <tr>
        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
            No record found
        </td>
    </tr>
@else
    @foreach($categories as $category)
        <tr>
            <!-- Category Name -->
            <td class="px-4 py-2">{{ $category->category_name }}</td>

            <!-- Color Code -->
            <td class="px-4 py-2 flex items-center space-x-2">
                <span class="inline-block w-3 h-3 rounded-full" style="background: {{ $category->color_hex }};"></span>
                <span>{{ $category->color_hex }}</span>
            </td>

            <!-- Status -->
            <td class="px-4 py-2">
                @php
                    $statusClasses = [
                        0 => 'bg-gray-200 text-gray-700',    // Inactive
                        1 => 'bg-green-100 text-green-700',  // Active
                        2 => 'bg-yellow-100 text-yellow-700' // Draft
                    ];
                    $statusLabels = [
                        0 => 'Inactive',
                        1 => 'Active',
                        2 => 'Draft'
                    ];
                @endphp
                <span class="px-2 py-1 text-xs font-medium rounded {{ $statusClasses[$category->status] ?? 'bg-gray-200 text-gray-700' }}">
                    {{ $statusLabels[$category->status] ?? 'Unknown' }}
                </span>
            </td>

            <!-- Action Dropdown -->
            <td class="px-4 py-2 text-left relative w-32">
                <div x-data="{ open: false }" class="inline-block relative">
                    <!-- Three dots button -->
                    <button @click="open = !open"
                            class="p-2 rounded-full hover:bg-gray-100 focus:outline-none font-bold">
                        &#x2026;
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open"
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-x-2"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-2"
                         class="absolute left-0 top-1/2 -translate-y-1/2 mr-2 w-24 bg-white border border-gray-200 rounded-lg z-10">

                        <a href="{{ route('categories.edit', $category->id) }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this Category ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Delete
                            </button>
                        </form>
                    </div>
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

