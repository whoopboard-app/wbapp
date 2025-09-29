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
                    <input id="teamSearch" class="input-field w-100 rounded ps-5" placeholder="Search">
                    <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute category-search-icon" style="top: 50%; left: 10px; transform: translateY(-50%);" alt="">
                </div>
              
                <div class="table-responsive">
                    @include('invite.partials.team_table', ['teamMembers' => $teamMembers])
                </div>
              
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        console.log('test');
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
    });
</script>
@endsection