<div id="teamTable" class="dataTables_wrapper dt-bootstrap5 no-footer">
    <table id="teamMemberSearch" class="table table-bordered align-middle dataTable no-footer" aria-describedby="teamMemberSearch_info">
        <thead class="table-light">
            <tr>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Full Name: activate to sort column descending" style="width: 345.541px;">Full Name</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 238.615px;">Email</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 74.1458px;">Role</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 89.906px;">Status</th>
                <th class="" tabindex="0" aria-controls="teamMemberSearch" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 87.4583px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teamMembers as $member)
                <tr>
                    <td>{{ ucfirst($member->first_name) }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                    {{ $member->userTypeLabel() }}
                    </td>
                    <td>
                        <span class="badge 
                            {{ $member->status == '1' ? 'status-active' : ($member->status == '2' ? 'status-inactive' : 'status-pending') }} 
                            rounded">
                            {{ $member->status == '1' ? 'Active' : ($member->status == '2' ? 'Inactive' : 'Pending') }}
                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-md btn-transparent fw-bold p-0 border-0" type="button" data-bs-toggle="dropdown">
                                …
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                            </ul>
                        </div>
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
        <div>
            Showing {{ $teamMembers->firstItem() }} to {{ $teamMembers->lastItem() }} of {{ $teamMembers->total() }} entries
        </div>
        <div>
            {{ $teamMembers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>