@if($tags->isEmpty())
    <tr>
        <td colspan="3" class="px-4 py-4 text-center text-gray-500">
            No record found
        </td>
    </tr>
@else
    @foreach($tags as $tag)
        <tr>
            <td class="px-4 py-2 w-1/5 whitespace-normal">{{ $tag->tag_name }}</td>
            <td class="px-4 py-2">
                @if($tag->functionalities->count())
                    @foreach($tag->functionalities as $func)
                        <span class="inline-block bg-gray-100 text-gray-600 text-sm px-2 py-1 rounded mr-1 font-bold">
                            @customLabel($func->name)
                        </span>
                    @endforeach
                @else
                    <span class="text-gray-400 text-sm">No module assigned</span>
                @endif
            </td>
            <td class="px-4 py-2 text-left relative w-32">
                    <!-- Action Dropdown -->
                        <div class="d-flex align-items-center sm justify-content-start gap-2 action-icons-wrapper">
                            <!-- Edit -->
                            <a href="{{ route('tags.edit', $tag->id) }}">
                                <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit" class="action-icon">
                            </a>

                            <div class="divider"></div>

                            <!-- View / Status -->
                            <a href="javascript:void(0)"
                               class="view-category"
                               data-id="{{ $tag->id }}">
                                <img src="{{ asset('assets/img/icon/oval.svg') }}" alt="oval" class="action-icon">
                            </a>

                            <div class="divider"></div>

                            <!-- Delete -->
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="m-0 p-0 d-inline"
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

        searchInput.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetch(`{{ route('guide.setup.changelog.tags') }}?search=${encodeURIComponent(this.value)}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(res => res.text())
                    .then(html => {
                        tableBody.innerHTML = html; // replace table body
                    });
            }, 300); // debounce for performance
        });
    });
</script>
