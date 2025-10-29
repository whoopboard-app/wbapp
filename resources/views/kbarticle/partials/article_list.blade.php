<div class="table-responsive border-0">
    <table id="listingKB" class="table align-middle board-table mb-0 border-0">
        <thead class="table-light">
        <tr>
            <th>Status</th>
            <th>Board Name</th>
            <th>Aurthor</th>
            <th>Listing Order</th>
            <th>Popular Article</th>
            <th>Creation Date</th>
            <th>Average Score</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($articles as $article)
            @php
                $statusClasses = [
                            'active' => 'status-active',
                            'inactive' => 'status-inactive',
                            'draft' => 'status-draft',
                            'saved' => 'status-saved',
                        ];

                        $statusLabels = [
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'draft' => 'Draft',
                            'saved' => 'Saved',
                        ];
                        $currentStatus = $article->status ?? 'inactive';
            @endphp
            <tr>
                <td>
                    @php $currentStatus = $article->status ?? 'inactive'; @endphp
                    <span class="badge fw-normal bg-white {{ $statusClasses[$currentStatus] ?? 'status-inactive' }} rounded-pill">
                        {{ $statusLabels[$currentStatus] ?? 'Unknown' }}
                    </span>
                </td>
                <td><span class="text-sm">{{ $article->title }}</span></td>
                @php
                    $authorIds = json_decode($article->author, true) ?? [];
                    $authorNames = \App\Models\User::whereIn('id', $authorIds)
                        ->selectRaw("CONCAT(name, ' ', last_name) as full_name")
                        ->pluck('full_name')
                        ->toArray();
                @endphp
                <td><span class="text-sm">{{ implode(', ', $authorNames) }}</span></td>
                <td><span class="text-sm">{{ $article->list_order }}</span></td>
                <td><span class="text-sm">{{ $article->popular_article ? 'Yes' : 'No' }}</span></td>
                <td><span class="text-sm">{{ $article->created_at }}</span></td>
                <td>
                    <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                        {{ $article->like_percentage ?? 0 }}%
                        <img src="{{ asset('assets/img/icon/thumbs-up.svg') }}" alt="like" class="icon-sm">
                    </span>
                    <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                        {{ $article->dislike_percentage ?? 0 }}%
                        <img src="{{ asset('assets/img/icon/thumbs-down.svg') }}" alt="dislike" class="icon-sm">
                    </span>
                </td>
                <td>
                    <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="View Board">
                        <a href="{{ route('board.categories', $article->id) }}">
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
</div>
@if ($articles->hasPages())
    <div class="d-flex justify-content-center align-items-center py-3 border-top">
        {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
@endif
