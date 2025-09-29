@extends('layouts.add_changelog')

@section('content')
<style>
    .para {
        font-size: 15px !important;
    }
    .let_spc{
        letter-spacing: 0.4px !important;
    }
    .badge.status-active {
        background-color: #E0FFE9;
        color: #1C8139;
    }
    .badge.status-inactive {
        background-color: #FFE5B4; 
        color: #FF8C00;           
    }
    .badge.status-pending {
        background-color: #E0F0FF; 
        color: #0056B3;           
    }
    .table thead th, .table tbody td {
        font-size: 14px;
        border: 0;
        border-bottom: 1px solid #dee2e6;
    }
    table.table-bordered.dataTable {
        border-right-width: 1px !important;
        border-left-width: 1px !important;
    }

    .input-field{
        border: 1px solid #d1d9e0 !important;
    }
    .input-field[readonly]
    {
        background-color: #59636E1A;
        border: 1px solid #D1D9E0;
        pointer-events: none;
    }
    .tooltip-icon:hover i {
        color: #007bff; /* Bootstrap blue on hover */
        cursor: pointer;
    }
    @media (min-width: 992px) {
    .section-content-center {
        max-width: 983px;
        margin: 0 auto;
    }
}
</style>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif

    <section class="section-content-center">
        <div class="container py-4">
            <h4 class="fw-bold fs-4 mb-2 let_spc">Add New Team</h4>
            <p class="text-muted label mb-4 para">
                Create tags to organize content across modules — including Changelog, Knowledge Board, Feedback, and Research. Tags help users quickly find related items.
            </p>
            <form action="{{ route('invite.store') }}" method="POST" class=" w-100">
                @csrf
                    <div class="card bg-white mb-3">
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="">
                                    <label for="firstName" class="input-label mb-1 fw-medium">First Name
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="First name" data-bs-original-title="First name"><i class="fa fa-question-circle"></i></span>
                                    </label>
                                    <input id="firstName" name="firstName" class="input-field w-100 rounded" placeholder="Placeholder" required>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <div class="">
                                    <label for="email" class="mb-1 fw-medium">Email Address
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Email Address" data-bs-original-title="First name"><i class="fa fa-question-circle"></i></span>
                                    </label>
                                    <input type="email" id="email" name="email" class="input-field w-100 rounded" placeholder="Placeholder" required>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="">
                                    <label for="user_type" class="input-label mb-1 fw-medium">Role
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="First name" data-bs-original-title="Role"><i class="fa fa-question-circle"></i></span>
                                    </label>
                                    <select id="user_type" name="user_type" class="input-field w-100 rounded" required>
                                        <option value="">-- Select Role --</option>
                                        <option value="1" disabled>Super Administrator (Owner)</option>
                                        <option value="2">Administrator</option>
                                        <option value="3">Manager</option>
                                        <option value="4">Editor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <a href="#" class="text-dark fw-medium text-decoration-underline">View Role Access</a>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="theme-btn rounded border-0 fw-bold let_spc">Send Invite</button>
                            </div>
                        </div>

                    </div>
                    
            </form>
                            <!-- Table Section -->
            <div class="form-section card bg-white mt-3">
                <h6 class="fw-bold">Team Member ({{ $teamCount }})</h6>
                <div class="mb-3 position-relative mt-2 x">
                    <input id="teamSearch" class="input-field w-100 rounded ps-5" placeholder="Search">
                    <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute category-search-icon" style="top: 50%; left: 10px; transform: translateY(-50%);" alt="">
                </div>
              
                <div class="table-responsive">
                    @include('invite.partials.team_table', ['teamMembers' => $teamMembers])
                </div>
              
            </div>
        </div>
        <div class="modal fade" id="editMemberModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editMemberForm" action="{{ route('invite.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-4 fw-semibold">Edit Team Member</h5>
                            <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="firstName" class="input-label mb-1 fw-medium">First Name
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="First name" data-bs-original-title="First name"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <input id="firstName" name="first_name" class="input-field w-100 rounded" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-1 fw-medium">Email Address
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Email Address" data-bs-original-title="Email"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <input type="email" id="email" name="email" class="input-field w-100 rounded" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="user_type" class="mb-1 fw-medium">User Type
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="User Type" data-bs-original-title="User Type"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <select id="user_type" name="user_type" class="input-field w-100 rounded" required>
                                    <option value="">-- Select Role --</option>
                                    <option value="1" disabled>Super Administrator</option>
                                    <option value="2">Administrator</option>
                                    <option value="3">Manager</option>
                                    <option value="4">Editor</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="mb-1 fw-medium">Status
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Status" data-bs-original-title="Status"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <select id="status" name="status" class="input-field w-100 rounded" required>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="3">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#teamSearch').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: "{{ route('invite.search') }}",
                method: 'GET',
                data: { search: query },
                success: function(response) {
                    $('#teamTable').html(response);
                }
            });
        });

        $('.edit-member').click(function(e) {
            e.preventDefault();
            
            const button = $(this).closest('.dropdown').find('button');
            const id = button.data('id');
            const first_name = button.data('first_name');
            const last_name = button.data('last_name');
            const email = button.data('email');
            const user_type = button.data('user_type');
            const status = button.data('status');

            // Populate your form fields
            $('#editMemberForm input[name="id"]').val(id);
            $('#editMemberForm input[name="first_name"]').val(first_name);
            $('#editMemberForm input[name="last_name"]').val(last_name);
            $('#editMemberForm input[name="email"]').val(email);
            $('#editMemberForm select[name="user_type"]').val(user_type);
            $('#editMemberForm select[name="status"]').val(status);

            // Show modal or scroll to form
            $('#editMemberModal').modal('show'); // if using Bootstrap modal
        
        });
    });
</script>
@endsection