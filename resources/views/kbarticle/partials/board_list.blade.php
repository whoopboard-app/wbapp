@if($boards->isEmpty())
    <p class="text-muted">No boards found.</p>
@else
    @foreach($boards as $board)
        @php
            $statusClasses = [
                0 => 'bg-gray-200 text-gray-700',
                1 => 'bg-green-100 text-green-700',
                2 => 'bg-yellow-100 text-yellow-700'
            ];
            $statusLabels = [
                0 => 'Inactive',
                1 => 'Active',
                2 => 'Draft'
            ];
        @endphp
        <div class="card mb-3 bg-white border board-clickable" data-href="{{ route('board.categories', $board->id) }}">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between">
                    <div>
                <span class="px-2 py-1 text-xs font-medium rounded {{ $statusClasses[$board->type] ?? 'bg-gray-200 text-gray-700' }}">
                    {{ $statusLabels[$board->type] ?? 'Unknown' }}
                </span>
                        <h5 class="pt-2 fw-semibold h5">{{$board->name}}</h5>
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Three dots dropdown -->
                        <div class="dropdown">
                            <a href="#" class="text-dark" role="button" id="boardMenu{{ $board->id }}"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-h"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="boardMenu{{ $board->id }}">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editBoardModal{{ $board->id }}">
                                        <i class="fa fa-edit me-2"></i> Edit Board
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('board.destroy', $board->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this board?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fa fa-trash me-2"></i> Delete Board
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <p class="card-text label pb-2">{{$board->description}}</p>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    @if($board->categories && $board->categories->count())
                        @foreach($board->categories as $category)
                            <span class="badge bg-white rounded-pill text-dark border">
                        {{ $category->name }}
                    </span>
                        @endforeach
                    @else
                        <p class="text-muted text-center">No Category added for this Board Yet.</p>
                    @endif
                    <span class="badge bg-white rounded-pill text-url border d-flex align-items-center gap-1">
                            <span class="textToCopied text-gray-500">{{$board->public_url}}</span>
                        <img src="{{ asset('assets/img/icon/clipboard.svg') }}"
                             class="copyBtn"
                             style="cursor:pointer; width:16px; height:16px;"
                             onclick="copyToClipboard(event, this)"
                             data-url="{{ $board->public_url }}"
                             data-bs-toggle="tooltip"
                             data-bs-placement="top"
                             title="Copy to clipboard"
                             alt="Copy">
                        </span>
                </div>
            </div>
        </div>
        @include('kbarticle.partials.edit_board_model', ['board' => $board])
        @endforeach
@endif
<script>    function copyToClipboard(event, el) {
        event.stopPropagation();
        event.preventDefault();
        const url = el.getAttribute('data-url');
        if (!url) return;

        navigator.clipboard.writeText(url).then(() => {
            const originalTitle = el.getAttribute('data-bs-original-title') || el.getAttribute('title') || 'Copy to clipboard';

            // dispose any previous tooltip
            let tip = bootstrap.Tooltip.getInstance(el);
            if (tip) tip.dispose();

            // create tooltip with "Copied!"
            tip = new bootstrap.Tooltip(el, {
                trigger: 'manual',
                title: 'Copied!',
                placement: el.getAttribute('data-bs-placement') || 'top',
                container: 'body'
            });
            tip.show();

            // hide & restore tooltip text
            setTimeout(() => {
                tip.hide();
                tip.dispose();

                // reset back to original title for hover
                el.setAttribute('data-bs-original-title', originalTitle);

                // reinitialize hover tooltip
                new bootstrap.Tooltip(el, {
                    trigger: 'hover',
                    title: originalTitle,
                    placement: el.getAttribute('data-bs-placement') || 'top',
                    container: 'body'
                });
            }, 1600);
        }).catch(err => {
            console.error('Failed to copy to clipboard', err);
        });
    }
</script>
