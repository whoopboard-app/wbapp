<div class="table-responsive border-0">
    <table id="listingKB" class="table align-middle board-table mb-0 border-bottom">
        <thead class="table-light">
        <tr>
            <th>Status</th>
            <th>Board Name</th>
            <th>Type</th>
            <th>Total Articles</th>
            <th>Total Categories</th>
            <th>Creation Date</th>
            <th>Average Score</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($boards as $board)
            @php
                $statusClasses = [0 => 'status-inactive', 1 => 'status-active'];
                $statusLabels = [0 => 'Private Board', 1 => 'Public Board'];
            @endphp
            <tr>
                <td>
                    <span class="badge fw-normal bg-white {{ $statusClasses[$board->type] ?? 'inactive' }} rounded-pill">
                        {{ $statusLabels[$board->type] ?? 'Unknown' }}
                    </span>
                </td>
                <td><span class="text-sm">{{ $board->name }}</span></td>
                <td><span class="text-sm">{{ $board->docs_type }}</span></td>
                <td><span class="text-sm">{{ count($board->articles) ?? 0 }}</span></td>
                <td><span class="text-sm">{{ count($board->categories) ?? 0 }}</span></td>
                <td><span class="text-sm">{{ $board->created_at }}</span></td>
                <td>
                    <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                        {{ $board->like_percentage ?? 0 }}%
                        <img src="{{ asset('assets/img/icon/thumbs-up.svg') }}" alt="like" class="icon-sm">
                    </span>
                    <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                        {{ $board->dislike_percentage ?? 0 }}%
                        <img src="{{ asset('assets/img/icon/thumbs-down.svg') }}" alt="dislike" class="icon-sm">
                    </span>
                </td>
                <td>
                    <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="View Board">
                        <a href="{{ route('board.categories', $board->id) }}">
                            <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="view">
                        </a>
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">No boards found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    @include('changelog.partials.pagination', ['paginator' => $boards])
</div>
