@if($tenantfields->isEmpty())
    <tr>
        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
            No record found
        </td>
    </tr>
@else
    @foreach($tenantfields as $field)
        <tr class="border-bottom">
            <!-- Status -->
            <td class="py-2">
                @php
                    $statusClasses = [
                        0 => 'status-inactive',
                        1 => 'status-active',
                        2 => 'status-draft',
                        3 => 'status-schedule',
                    ];

                    $statusLabels = [
                        0 => 'Inactive',
                        1 => 'Active',
                        2 => 'Draft',
                        3 => 'Scheduled',
                    ];

                    $status = $field->status;
                    $badgeClass = $statusClasses[$status] ?? 'status-inactive';
                    $badgeLabel = $statusLabels[$status] ?? 'Unknown';
                @endphp

                <span class="badge fw-normal bg-white {{ $badgeClass }} rounded-pill border-1">
            {{ $badgeLabel }}
        </span>
            </td>
            <td class="py-2">{{ $field->option_name }}</td>
            <td class="py-2">{{ $field->segmentField->field_name ?? 'N/A'  }}</td>
            <!-- Action Dropdown -->
            <td>
                <div class="icon-box d-flex align-items-center gap-2">
                    <!-- Edit -->
                    <a href="{{ route('segments.edit', $field->id) }}">
                        <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit" style="max-width:15px;">
                    </a>

                    <div class="divider"></div>

                    <!-- View -->
                    <a href="javascript:void(0)"
                       class="view-member"
                       data-id="{{ $field->id }}">
                        <img src="{{ asset('assets/img/icon/oval.svg') }}" alt="View" style="max-width:15px;">
                    </a>

                    <div class="divider"></div>

                    <!-- Delete -->
                    <a href="javascript:void(0)">
                        <form action="{{ route('categories.destroy', $field->id) }}" method="POST" class="m-0 p-0 d-inline"
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

        function fetchOptions(url) {
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
                    fetchOptions(this.href);
                });
            });
        }

        // Debounced search
        searchInput.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const url = `{{ route('segment.view') }}?search=${encodeURIComponent(this.value)}`;
                fetchOptions(url);
            }, 300);
        });

        // Initial binding
        bindPaginationLinks();
    });
</script>

