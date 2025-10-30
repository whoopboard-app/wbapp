@extends('layouts.app')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="error" :message="$errors->first()" />
        @endforeach
    @endif

    <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
        <div class="d-flex justify-content-between mb-2">
            <h4 class="fw-medium font-16">Team Members</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-2">
                <a href="{{ route('app.settings') }}"
                   class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to App Settings
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 view-changelog-details">
                <!-- Add New Team Member -->
                <div class="card p-0 bg-white mb-3">
                    <form id="teamMemberForm" method="POST" class="form">
                        @csrf
                        <input type="hidden" name="id" id="memberId">
                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 id="formTitle" class="fw-medium mb-0">Add New Team Member</h4>
                        </div>

                        <div class="content-body px-3">
                            <p class="label color-support fw-medium mt-2">
                                Create and organize categories to group your product updates. Categories make it easier for users to browse updates by topic or type.
                            </p>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-input">
                                        <label for="firstName" class="input-label mb-1 fw-medium">First Name</label>
                                        <input type="text" name="firstName" id="firstName" class="input-field w-100 rounded" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-input">
                                        <label for="lastName" class="input-label mb-1 fw-medium">Last Name</label>
                                        <input type="text" name="lastName" id="lastName" class="input-field w-100 rounded" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="email" class="input-label mb-1 fw-medium">Email Address</label>
                                        <input type="email" name="email" id="email" class="input-field w-100 rounded" placeholder="Enter Email Address" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="user_type" class="input-label mb-1 fw-medium">Role</label>
                                        <select id="user_type" name="user_type" class="w-100 border-gray-300 rounded" required>
                                            <option value="">Select Role</option>
                                            <option value="1" disabled>Super Administrator (Owner)</option>
                                            <option value="2">Administrator</option>
                                            <option value="3">Manager</option>
                                            <option value="4">Editor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer gap15 px-3 d-flex justify-content-start" style="background-color: #FCFCFC;">
                            <button type="submit" id="submitBtn" class="theme-btn sm fw-semibold rounded d-inline-block">Send Invite / Add Team Member</button>
                            <a href="{{ route('invite.create') }}" type="button" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Canel</a>
                        </div>
                    </form>
                </div>

                <!-- Team Members Table -->
                <div class="card pt-0 px-0 bg-white mt-3">
                    <div class="d-flex border-title align-items-center justify-content-between px-3">
                        <h4 class="fw-medium mb-0">Team Members ({{ $teamCount }})</h4>
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                            <div class="position-relative form-group">
                                <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="Search">
                                <input id="teamSearch" type="search" class="input-field w-100 rounded ps-5" placeholder="Search">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @include('invite.partials.team_table', ['teamMembers' => $teamMembers])
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
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
                                <label for="first_name" class="input-label mb-1 fw-medium">First Name</label>
                                <input id="first_name" name="first_name" class="input-field w-100 rounded" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-1 fw-medium">Email Address</label>
                                <input type="email" id="email" name="email" class="input-field w-100 rounded" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="user_type" class="mb-1 fw-medium">Role</label>
                                <select id="user_type" name="user_type" class="input-field w-100 rounded" required>
                                    <option value="">Select Role</option>
                                    <option value="1" disabled>Super Administrator</option>
                                    <option value="2">Administrator</option>
                                    <option value="3">Manager</option>
                                    <option value="4">Editor</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="mb-1 fw-medium">Status</label>
                                <select id="status" name="status" class="input-field w-100 rounded" required>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="3">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('invite.create') }}" type="button" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Canel</a>
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
            $('#teamSearch').on('search', function() {
                if ($(this).val().trim() === '') {
                    $.ajax({
                        url: "{{ route('invite.search') }}",
                        method: 'GET',
                        data: { search: '' },
                        success: function(response) {
                            $('#teamTable').html(response);
                        }
                    });
                }
            });
            resetForm();
            $(document).on('click', '.edit-member', function(e) {
                e.preventDefault();

                const member = $(this).data();
                $('#memberId').val(member.id);
                $('#firstName').val(member.first_name);
                $('#lastName').val(member.last_name);
                $('#email').val(member.email);
                $('#user_type').val(member.user_type);
                $('#status').val(member.status);

                $('#formTitle').text('Edit Team Member');
                $('#submitBtn').text('Save Changes');

                $('#teamMemberForm')
                    .attr('action', "{{ route('invite.update') }}")
                    .attr('method', 'POST')
                    .append('@method("PUT")');
            });

            function resetForm() {
                $('#teamMemberForm').attr('action', "{{ route('invite.store') }}");
                $('#formTitle').text('Add New Team Member');
                $('#submitBtn').text('Send Invite / Add Team Member');
                $('#teamMemberForm').find('input[type=text], input[type=email]').val('');
                $('#teamMemberForm').find('select').val('');
                $('#memberId').val('');
                $('#teamMemberForm').find('input[name="_method"]').remove();
            }
            $('.cancel-btn').on('click', function(e) {
                e.preventDefault();
                resetForm();
            });
        });
    </script>
@endsection
