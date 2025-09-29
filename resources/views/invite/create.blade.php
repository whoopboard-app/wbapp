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
@if (session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if (session('error'))
    <x-alert type="error" :message="session('error')" />
@endif

@if (session('info'))
    <x-alert type="info" :message="session('info')" />
@endif

@if (session('warning'))
    <x-alert type="warning" :message="session('warning')" />
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
                                        <option value="1">Super Administrator (Owner)</option>
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
                    <input class="input-field w-100 rounded ps-5" placeholder="Search">
                    <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute category-search-icon" style="top: 50%; left: 10px; transform: translateY(-50%);" alt="">
                </div>
                <form action="#">
                <div class="table-responsive">
                <div id="teamMemberSearch_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><table id="teamMemberSearch" class="table table-bordered align-middle dataTable no-footer" aria-describedby="teamMemberSearch_info">
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
                <!-- <div class="bottom"><div class="dataTables_info" id="teamMemberSearch_info" role="status" aria-live="polite">Showing 1 to 2 of 2 entries</div></div></div>
                </div> -->
                <button class="theme-btn sm  fw-semibold secondary rounded">Previous</button>
                <button class="theme-btn sm secondary fw-semibold rounded">Next</button>
                </form>
            </div>
        </div>
    </section>
@endsection