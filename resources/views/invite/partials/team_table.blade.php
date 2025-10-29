<div id="teamTable" class="dataTables_wrapper dt-bootstrap5 no-footer">
    <table id="teamMemberSearch" class="table table-bordered align-middle dataTable no-footer" aria-describedby="teamMemberSearch_info">
        <thead class="table-light">
            <tr>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 89.906px;">Status</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Full Name: activate to sort column descending" style="width: 200px;">Full Name</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 200px;">Email</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 100px;">Role</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 87.4583px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teamMembers as $member)
                <tr>
                    <td>
                    <span class="badge fw-normal bg-white
                        {{ $member->status == '1' ? 'status-active' : ($member->status == '2' ? 'status-inactive' : 'status-pending') }}
                        rounded-pill border-1">
                        {{ $member->status == '1' ? 'Active' : ($member->status == '2' ? 'Inactive' : 'Pending') }}
                    </span>
                    </td>
                    <td>{{ ucfirst($member->first_name) }} {{ ucfirst($member->last_name) }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                    {{ $member->userTypeLabel() }}
                    </td>
                    <td>
                        @isSuperAdmin
                        <div class="icon-box d-flex align-items-center gap-2">
                            <!-- Edit -->
                            <a href="javascript:void(0)"
                               class="edit-member"
                               data-id="{{ $member->id }}"
                               data-first_name="{{ $member->first_name }}"
                               data-last_name="{{ $member->last_name }}"
                               data-email="{{ $member->email }}"
                               data-user_type="{{ $member->user_type }}"
                               data-status="{{ $member->status }}">
                                <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit" style="max-width:15px;">
                            </a>

                            <div class="divider"></div>

                            <!-- View -->
                            <a href="javascript:void(0)"
                               class="view-member"
                               data-id="{{ $member->id }}">
                                <img src="{{ asset('assets/img/icon/oval.svg') }}" alt="View" style="max-width:15px;">
                            </a>

                            <div class="divider"></div>

                            <!-- Delete -->
                            <a href="javascript:void(0)">
                            <form action="{{ route('invite.destroy', $member->id) }}" method="POST" class="m-0 p-0 d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this member?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-0 bg-transparent p-0">
                                    <img src="{{ asset('assets/img/icon/trash.svg') }}" alt="trash" class="action-icon">
                                </button>
                            </form>
                            </a>
                        </div>
                        @else
                            <div class="text-muted">—</div>
                            @endisSuperAdmin
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No team members found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="pl-2">
            Showing {{ $teamMembers->firstItem() }} to {{ $teamMembers->lastItem() }} of {{ $teamMembers->total() }} entries
        </div>
        <div>
            {{ $teamMembers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
