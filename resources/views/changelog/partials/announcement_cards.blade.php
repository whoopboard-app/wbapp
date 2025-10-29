<style>
    .changelog-table {
        border: 1px solid #dee2e6; /* Light outer border */
        border-collapse: separate;
        border-spacing: 0;
    }

    .changelog-table th,
    .changelog-table td {
        border-left: none !important;  /* Remove vertical borders */
        border-right: none !important; /* Remove vertical borders */
    }

    .changelog-table tr {
        border-bottom: 1px solid #e9ecef; /* Light row separators */
    }

    .changelog-table thead tr {
        border-bottom: 2px solid #dee2e6; /* Slightly stronger header border */
    }

    .table-responsive{
        margin-top: 0px !important;
    }

    .card{
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom: none;
    }

    .reaction {
        padding: 6px 10px;
    }

    .icon-sm {
        width: 14px;
        height: 14px;
        object-fit: contain;
    }

    table#listingChangelog{
        margin-bottom: 0px !important;
    }

    .pagination{
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }


</style>
<div class="table-responsive">
    <div id="listingChangelog_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
        <table id="listingChangelog" class="table align-middle changelog-table border-top-0" style="width: 100%;">
            <thead class="table-light">
                <tr>
                    <th>Status</th>
                    <th>Title</th>
                    <th>Published Date</th>
                    <th>Category</th>
                    <th>Score</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($announcements as $announcement)
                    <tr>
                        <td>
                            <span class="badge fw-normal bg-white
                                @if($announcement->status == 'draft') draft
                                @elseif($announcement->status == 'inactive') inactive
                                @else published @endif rounded-pill">
                                {{ ucfirst($announcement->status) }}
                            </span>
                        </td>

                        <td>
                            <span class="text-sm">{{ $announcement->title }}</span>
                        </td>

                        <td>
                            <span class="text-sm">{{ $announcement->created_at->format('F d, Y \\a\\t h:i A') }}</span>
                        </td>

                        <td>
                            @php
                                $catNames = $announcement->category_names ?? [];
                            @endphp

                            @if(count($catNames) > 0)
                                @foreach(array_slice($catNames, 0, 2) as $cat)
                                    <span class="badge fw-normal bg-white published-category border text-dark rounded-pill">
                                        {{ $cat }}
                                    </span>
                                @endforeach
                                @if(count($catNames) > 2)
                                    <span class="badge fw-normal bg-white more-category rounded-pill tooltip-icon" data-bs-toggle="tooltip" title="Other categories">
                                        +{{ count($catNames) - 2 }}
                                    </span>
                                @endif
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>


                        <td>
                            <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                                {{ $announcement->likes_percent ?? 0 }}%
                                <img src="{{ asset('assets/img/icon/thumbs-up.svg') }}" alt="like" class="icon-sm">
                            </span>
                            <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                                {{ $announcement->dislikes_percent ?? 0 }}%
                                <img src="{{ asset('assets/img/icon/thumbs-down.svg') }}" alt="dislike" class="icon-sm">
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="View">
                                <a href="{{ route('announcement.show', $announcement->id) }}">
                                    <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="">
                                </a>
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No change logs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="border border-top-0 rounded-bottom">
            @include('changelog.partials.pagination', ['paginator' => $announcements])
        </div>

    </div>
</div>

