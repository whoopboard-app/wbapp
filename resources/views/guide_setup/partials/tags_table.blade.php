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

                        <!-- Edit -->
                        <a href="{{ route('tags.edit', $tag->id) }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this Tag ?');">
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
