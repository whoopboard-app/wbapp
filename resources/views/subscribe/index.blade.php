@extends('layouts.app')

@section('content')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif
<style>
    .ts-wrapper {
        padding: 0 10px !important;
        border: 1px solid #d1d9e0;
    }
    .ts-control {
        border: none !important;
        align-content: center !important;
    }
    .form-select{
        border: 1px solid #d1d9e0;
    }
    .p-text {
        font-size: 17px !important;
    }
    .ts-dropdown, .ts-control, .ts-control input {
        font-size: 14px !important;
    }
    label, .text-muted, .label {
        font-size: 15px !important;
    }
    main.flex-1.p-8.pb-48{
        padding-top : 0px !important;
        padding-left : 0px !important;
        padding-right : 0px !important;
    }
    .pagination a.disabled {
        pointer-events: none;
        opacity: 0.5;
    }

    td{
        border-bottom: 1px solid #dee2e6 !important;
    }

    .table thead th {
        border-top: 0;
        border-bottom: 0 !important;
        font-weight: 400 !important;
    }

    .info-card {
        border-bottom: 0.5px solid #969695;
    }
   .info-card .info-tag {
        background-color: #E1E1E0;
        border: 1px solid #E1E1E0;
        padding: 6px 8px;
        border-radius: 6px;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<section class=" main-content-wrapper">
    <div class="d-flex justify-content-between">
        <h4 class="fw-medium font-16 ">Subscribe List</h4>
        <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-0">
                <a href="#" class="theme-btn sm fw-semibold rounded d-inline-block" data-bs-toggle="modal" data-bs-target="#addSegmentation"> 
                Add Subscribe Member
            </a>
            
            <a href="{{ route('segmentation.create') }}" class="theme-btn text-primary bg-white sm secondary fw-semibold rounded d-inline-block">
                New User Segmentation
            </a>
            
        </div>
    </div>
    <div class="d-inline-block w-100 mt-10px">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-member-tab" data-bs-toggle="pill" data-bs-target="#pills-member" type="button" role="tab" aria-controls="pills-member" aria-selected="true">
                    All Subscribe Member
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-segmentatin-tab" data-bs-toggle="pill" data-bs-target="#pills-segmentation" type="button" role="tab" aria-controls="pills-segmentation" aria-selected="false" tabindex="-1">
                    Subscribe Segmentation
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-settings" type="button" role="tab" aria-controls="pills-settings" aria-selected="false" tabindex="-1">
                    Subscribe Member Settings
                </button>
            </li>
            
        </ul>
        
    </div>
    <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-member" role="tabpanel">
                <div class="row mt-20">
                    <div class="col-lg-12">
                        <div class="card pt-0 px-0 bg-white mb-3">
                            <div class="d-flex border-title align-items-center justify-content-between">
                                <h4 class="fw-medium mb-0">{{ $total_subs }} Subscribe List</h4>

                                <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="showImg">
                                        <label class="form-check-label" for="showImg">Show Image</label>
                                    </div>

                                    <div class="position-relative form-group">
                                        <input type="search" class="input-field w-100 rounded ps-5" placeholder="Search" id="customSearch">
                                        <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="">
                                    </div>

                                    <div class="form-group">
                                        <select id="statusFilter" class="form-select rounded">
                                            <option value="">All</option>
                                            <option value="1">Subscribe</option>
                                            <option value="0">Inactive</option>
                                            <option value="2">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="subscribersTable" class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Status</th>
                                            <th>Name</th>
                                            <th>Email Address</th>
                                            <th>Subscribe Date</th>
                                            <th>Segmentation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subscribers as $subscriber)
                                            <tr>
                                                <td>
                                                    @if($subscriber->status == 1)
                                                        <span class="badge fw-normal bg-white published rounded-pill">Subscribe</span>
                                                    @elseif ($subscriber->status == 2)
                                                        <span class="badge fw-normal bg-white draft rounded-pill">Pending</span>
                                                    @else
                                                        <span class="badge fw-normal bg-white inactive rounded-pill">Inactive</span>
                                                    @endif
                                                </td>

                                                <td>{{ $subscriber->full_name }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>
                                                    {{ $subscriber->subscribe_date ? $subscriber->subscribe_date->format('F d, Y') : '-' }}
                                                </td>
                                                <td>
                                                    @if(!empty($subscriber->segmentNames))
                                                        @foreach(array_slice($subscriber->segmentNames, 0, 2) as $name)
                                                            <span class="badge fw-normal bg-white border text-dark rounded-pill">
                                                                {{ $name }}
                                                            </span>
                                                        @endforeach

                                                        @if(count($subscriber->segmentNames) > 2)
                                                            <span class="badge fw-normal bg-white more-category rounded-pill tooltip-icon"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ implode(', ', array_slice($subscriber->segmentNames, 2)) }}">
                                                                +{{ count($subscriber->segmentNames) - 2 }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        —
                                                    @endif
                                                </td>


                                                <td>
                                                    <a href="#"
                                                        class="badge bg-white border text-dark tooltip-icon view-subscriber"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewSegmentation"
                                                        data-id="{{ $subscriber->id }}"
                                                        data-full_name="{{ $subscriber->full_name }}"
                                                        data-email="{{ $subscriber->email }}"
                                                        data-subscribe_date="{{ $subscriber->subscribe_date ? $subscriber->subscribe_date->format('F d, Y') : '-' }}"
                                                        data-user_segments="{{ implode(', ', $subscriber->segmentNames ?? []) }}"
                                                        data-status="{{ $subscriber->status }}"
                                                        data-about="{{ $subscriber->short_desc }}"
                                                        title="View">
                                                        <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="">
                                                    </a>
                                                    <a href="#"
                                                        class="badge bg-white border text-dark tooltip-icon edit-subscriber"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editSegmentation"
                                                        data-id="{{ $subscriber->id }}"
                                                        data-full_name="{{ $subscriber->full_name }}"
                                                        data-email="{{ $subscriber->email }}"
                                                        data-subscribe_date="{{ $subscriber->subscribe_date ? $subscriber->subscribe_date->format('F d, Y') : '-' }}"
                                                        data-status="{{ $subscriber->status }}"
                                                        data-about="{{ $subscriber->short_desc }}"
                                                        title="Edit">
                                                        <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div id="customPagination" class="d-flex align-items-center gap-3 px-3 pagination mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-segmentation" role="tabpanel" aria-labelledby="pills-segmentation-tab">
                <div class="row mt-20">
                    <div class="col-lg-12 ">
                            <div class="card pt-0 px-0 bg-white mb-3 ">
                            <div class="d-flex border-title align-items-center justify-content-between">
                            <h4 class="fw-medium mb-0 ">{{ $total_segments }} Segmentation List</h4>
                            <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="showImgSegments">
                                    <label class="form-check-label" for="showImgSegments">Show Image</label>
                                </div>
                                 <div class="position-relative form-group">
                                    <input type="search" class="input-field w-100 rounded ps-5" placeholder="Search" id="searchSegments">
                                    <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="">
                                </div>
                                <div class="form-group">
                                    <select id="segmentStatusFilter" class="form-select rounded">
                                        <option value="">All</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        <option value="2">Draft</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="table-responsive">
                                <div id="listingSegmentation_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                                    <table id="segmentsTable" class="table table-bordered align-middle dataTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Status</th>
                                            <th>User Segmentation</th>
                                            <th>Revenue Range</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($segments as $segment)
                                            <tr>
                                                <td>
                                                    @if($segment->status == 1)
                                                        <span class="badge fw-normal bg-white published rounded-pill">Active</span>
                                                    @elseif($segment->status == 2)
                                                        <span class="badge fw-normal bg-white draft rounded-pill">Draft</span>
                                                    @else
                                                        <span class="badge fw-normal bg-white inactive rounded-pill">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $segment->name }}</td>
                                                <td>{{ $segment->revenueRange->value ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="#"
                                                    class="badge bg-white border text-dark tooltip-icon"
                                                    data-bs-toggle="modal"
                                                    title="View">
                                                        <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div id="segmentsPagination" class="d-flex align-items-center gap-3 px-3 pagination mt-3"></div>
                    </div>
                    </div>
            
                </div>
            </div>
    </div>
    <div class=" modal fade" id="addSegmentation" tabindex="-1" aria-labelledby="addSegmentationLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
         <div class="modal-content border-0">
            <div class="modal-header">
               <div class="mb-0">
                  <h3 class="fw-semibold mb-0">Add Subscribe Member</h3>
               </div>
               <button type="button" class="modal-close bg-transparent border-0 ms-auto d-flex align-items-center justify-content-center" data-bs-dismiss="modal" aria-label="Close">
                <img src="{{ asset('assets/img/icon/modal-exit.svg') }}" alt="">
            </button>
            </div>
           <div class="modal-body">
             
               <form action="{{ route('subscribe.store') }}" method="POST" class="d-flex flex-column gap-3">
                    @csrf
                  <div class="row mt-3">
                    <div class="col-lg-6 mb-3">
                        <div class="">
                            <label for="first_name" class="input-label mb-1 fw-medium">
                                First Name
                            </label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name" 
                                class="input-field w-100 rounded" 
                                placeholder="Placeholder" 
                                required
                            >
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="">
                            <label for="last_name" class="input-label mb-1 fw-medium">
                                Last Name
                            </label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                class="input-field w-100 rounded" 
                                placeholder="Placeholder" 
                                required
                            >
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="">
                            <label for="email" class="input-label mb-1 fw-medium">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="input-field w-100 rounded" 
                                placeholder="Placeholder" 
                                required
                            >
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="">
                            <label for="linkedin_url" class="input-label mb-1 fw-medium">
                                LinkedIn URL
                            </label>
                            <input 
                                type="url" 
                                id="linkedin_url" 
                                name="linkedin_url" 
                                class="input-field w-100 rounded" 
                                placeholder="Placeholder" 
                            >
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="">
                            <label for="subscribe_date" class="input-label mb-1 fw-medium">
                                Subscribe Date
                            </label>
                            <div class="position-relative form-group">
                                <input 
                                    type="text" 
                                    id="subscribe_date" 
                                    name="subscribe_date" 
                                    class="input-field rounded ps-5 w-100" 
                                    placeholder="Placeholder" 
                                    required
                                >
                                <img src="{{ asset('assets/img/icon/calendar.svg') }}" class="position-absolute search-icon" alt="">
                            </div>    
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class=" ">
                             <label for="short_desc" class="input-label mb-1 fw-medium">
                                About the User
                            </label>
                            <textarea 
                                id="short_desc" 
                                name="short_desc" 
                                rows="3" 
                                class="input-field w-100 rounded" 
                                placeholder="Placeholder"
                                maxlength="300"
                            ></textarea>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="">
                            <label for="userSegments" class="input-label mb-1 fw-medium"> 
                                User Segments
                            </label>
                            <select 
                                class="form-select w-100 rounded" 
                                id="userSegments" 
                                name="userSegments[]" 
                                multiple 
                            >
                                @if($segments->isNotEmpty())
                                    <option value="" disabled>Select</option>
                                    @foreach($segments as $segment)
                                        <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No segments available</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="">
                           <label for="addType" class="input-label mb-1 fw-medium"> 
                                Type of Add
                            </label>
                            <select 
                                class="form-select w-100 rounded" 
                                id="addType" 
                                name="addType" 
                            >
                                <option value="" disabled selected>Select</option>
                                <option value="Premium">Premium health</option>
                                <option value="General">General</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="">
                            <label for="Status" class="input-label mb-1 fw-medium"> 
                               Status
                            </label>
                                <select class="form-select w-100 rounded" id="status" name="status" required>
                                    <option value="">Select</option>
                                    <option value="1">Subscribe</option>
                                    <option value="0">Inactive</option>
                                    <option value="2">Pending</option>
                                </select>
                        </div>
                    </div>
                  
                  </div>
                    
                 
              
            </div>
                <div class="modal-footer justify-content-start border-top-0">
                    <button type="submit" class="theme-btn fw-semibold rounded border-0">Add Subscribe</button>
                    <button type="button" class="theme-btn secondary bg-white fw-semibold rounded" data-bs-dismiss="modal">Close</button> 
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class=" modal fade" id="viewSegmentation" tabindex="-1" aria-labelledby="viewSegmentationLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
         <div class="modal-content border-0">
            <div class="modal-header">
               <div class="mb-0">
                  <h3 class="fw-semibold mb-0 fs-5">Subscribe View</h3>
               </div>
               <button type="button" class="modal-close bg-transparent border-0 ms-auto d-flex align-items-center justify-content-center" data-bs-dismiss="modal" aria-label="Close">
                <img src="{{ asset('assets/img/icon/modal-exit.svg') }}" alt="">
            </button>
            </div>
           <div class="modal-body">
             
               <form action="#" class="d-flex flex-column gap-3">
                  <div class="info-card">
                    <div class="row mb-3 mt-3">
                   
                    <div class="col-md-6">
                        <div class="info-label">First Name</div>
                        <div class="info-value fw-bold" id="modalFirstName"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Last Name</div>
                        <div class="info-value fw-bold" id="modalLastName"></div>
                    </div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="row mb-3">
                        <div class="col-12">
                             <div class="info-label">Email Address</div>
                            <div class="info-value fw-bold" id="modalEmail"></div>
                        </div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="row mb-3">
                        <div class="col-12">
                             <div class="info-label">Subscribe Date</div>
                            <div class="info-value fw-bold" id="modalSubscribeDate"></div>
                        </div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="row mb-3">
                        <div class="col-12">
                             <div class="info-label">User Segmentation</div>
                            <div class="d-flex justify-content-start gap-2 mt-1" id="modalUserSegments">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="row mb-3">
                        <div class="col-12">
                             <div class="info-label">Status</div>
                            <div class="d-flex justify-content-start gap-2 mt-1" id="modalStatus">
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="row mb-3">
                        <div class="col-12">
                             <div class="info-label">About Us</div>
                            <div class="info-value" id="modalAbout">
                               <i>
                                
                               </i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="info-card">
                    <div class="row mb-3">
                        <div class="col-12">
                             <div class="info-label">Unsubscribe Date</div>
                            <div class="info-value fw-bold text-danger">
                              April 10, 2025 
                            </div>
                        </div>
                    </div>
                </div> -->

                    
                 
               </form>
            </div>
            <div class="modal-footer justify-content-start border-top-0">
                <button type="button" class="theme-btn fw-semibold rounded" id="openEditFromView">
                    Edit
                </button>
               <button type="button" class="theme-btn secondary bg-white fw-semibold rounded" data-bs-dismiss="modal">Close</button> 
            </div>
          </div>
        </div>
    </div>

    <!-- Edit Subscriber Modal -->
    <div class="modal fade" id="editSegmentation" tabindex="-1" aria-labelledby="editSegmentationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0">
        <div class="modal-header">
            <h3 class="fw-semibold mb-0 fs-5">Edit Subscriber</h3>
            <button type="button" class="modal-close bg-transparent border-0 ms-auto d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets/img/icon/modal-exit.svg') }}" alt="">
            </button>
        </div>

        <div class="modal-body">
            <form id="editSubscriberForm" class="d-flex flex-column gap-3" method="POST" action="{{ route('subscribe.update') }}">
            @csrf
            <input type="hidden" id="editSubscriberId" name="id">

            <!-- Name -->
            <div class="info-card">
                <div class="row mb-3 mt-3">
                <div class="col-md-6">
                    <label class="info-label">First Name</label>
                    <input type="text" class="input-field w-100 rounded" id="editFirstName" name="first_name" required>
                </div>
                <div class="col-md-6">
                    <label class="info-label">Last Name</label>
                    <input type="text" class="input-field w-100 rounded" id="editLastName" name="last_name" required>
                </div>
                </div>
            </div>

            <!-- Email -->
            <div class="info-card">
                <div class="mb-3">
                <label class="info-label">Email Address</label>
                <input type="email" class="input-field w-100 rounded" id="editEmail" name="email" readonly>
                </div>
            </div>

             <div class="info-card">
                <div class="row mb-3">
                    <div class="col-12">
                            <div class="info-label">Subscribe Date</div>
                        <input type="email" class="input-field w-100 rounded" id="editSubscribeDate" name="date" readonly>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="info-card">
                <div class="mb-3">
                <label class="info-label">Status</label>
                <select class="form-select input-field rounded" id="editStatusSelect" name="status">
                    <option value="1">Subscribe</option>
                    <option value="2">Pending</option>
                    <option value="0">Inactive</option>
                </select>
                </div>
            </div>

            <!-- About -->
            <div class="info-card">
                <div class="mb-3">
                <label class="info-label">About</label>
                <textarea class="input-field w-100 rounded" id="editAbout" name="about" rows="3"></textarea>
                </div>
            </div>
            </form>
        </div>

        <div class="modal-footer justify-content-start border-top-0">
            <button type="submit" form="editSubscriberForm" class="theme-btn fw-semibold rounded">Update</button>
            <button type="button" class="theme-btn secondary bg-white fw-semibold rounded" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>


</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let table = $('#subscribersTable').DataTable({
        ordering: false,
        pageLength: 5,
        lengthChange: false,
        info: false,
        searching: true,
        paging: true,
        dom: 't',
        language: {
            emptyTable: "No subscriber found." 
        }
    });

    const paginationContainer = document.querySelector('#customPagination');

    // 🔹 Custom Pagination Renderer
    function renderPagination() {
        const pageInfo = table.page.info();
        const currentPage = pageInfo.page + 1;
        const totalPages = pageInfo.pages;

        if (totalPages === 0) {
            paginationContainer.innerHTML = '';
            return;
        }

        let html = '';

        html += `
            <a href="#" class="fw-semibold prev text-dark rounded sm ${currentPage === 1 ? 'disabled' : ''}" data-page="${currentPage - 1}">&lt; Previous</a>
            <div class="page-numbers d-flex align-items-center gap-2">
        `;

        for (let i = 1; i <= totalPages; i++) {
            html += `<a href="#" class="pagination-number ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`;
        }

        html += `
            </div>
            <a href="#" class="next fw-semibold text-dark rounded sm ${currentPage === totalPages ? 'disabled' : ''}" data-page="${currentPage + 1}">Next &gt;</a>
        `;

        paginationContainer.innerHTML = html;

        // 🔸 Pagination click events
        paginationContainer.querySelectorAll('a[data-page]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (this.classList.contains('disabled')) return; // prevent click on disabled
                const page = parseInt(this.getAttribute('data-page')) - 1;
                table.page(page).draw('page');
                renderPagination();
            });
        });
    }


    renderPagination();

    // 🔹 Custom Search Input
    const customSearch = document.querySelector('#customSearch');
    if (customSearch) {
        customSearch.addEventListener('input', function() {
            table.search(this.value).draw();
        });
    }

    // 🔹 Status Dropdown Filter
    const statusFilter = document.querySelector('#statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            const value = this.value;
            let searchValue = '';

            if (value === '') searchValue = '';
            else if (value === '1') searchValue = '^Subscribe$';
            else if (value === '2') searchValue = '^Pending$';
            else if (value === '0') searchValue = '^Inactive$';

            table.column(0).search(searchValue, true, false).draw();
        });
    }

    table.on('draw', renderPagination);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== Segments Table =====
    let segTable = $('#segmentsTable').DataTable({
        ordering: false,
        pageLength: 5,
        lengthChange: false,
        info: false,
        searching: true,
        paging: true,
        dom: 't',
        language: {
            emptyTable: "No segment found."
        }
    });

    const segPagination = document.querySelector('#segmentsPagination');

    function renderSegPagination() {
        const pageInfo = segTable.page.info();
        const currentPage = pageInfo.page + 1;
        const totalPages = pageInfo.pages;

        if (totalPages === 0) {
            segPagination.innerHTML = '';
            return;
        }

        let html = '';

        html += `
            <a href="#" class="fw-semibold prev text-dark rounded sm ${currentPage === 1 ? 'disabled' : ''}" data-page="${currentPage - 1}">&lt; Previous</a>
            <div class="page-numbers d-flex align-items-center gap-2">
        `;

        for (let i = 1; i <= totalPages; i++) {
            html += `<a href="#" class="pagination-number ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`;
        }

        html += `
            </div>
            <a href="#" class="next fw-semibold text-dark rounded sm ${currentPage === totalPages ? 'disabled' : ''}" data-page="${currentPage + 1}">Next &gt;</a>
        `;

        segPagination.innerHTML = html;

        // 🔹 Add click events
        segPagination.querySelectorAll('a[data-page]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (this.classList.contains('disabled')) return;
                const page = parseInt(this.getAttribute('data-page')) - 1;
                segTable.page(page).draw('page');
                renderSegPagination();
            });
        });
    }


    renderSegPagination();

    // 🔹 Segment Search
    const segSearch = document.querySelector('#searchSegments');
    if (segSearch) {
        segSearch.addEventListener('input', function() {
            segTable.search(this.value).draw();
        });
    }

    // 🔹 Segment Status Filter
    const segStatus = document.querySelector('#segmentStatusFilter');
    if (segStatus) {
        segStatus.addEventListener('change', function() {
            const value = this.value;
            let searchValue = '';

            if (value === '') searchValue = '';
            else if (value === '1') searchValue = '^Active$';
            else if (value === '2') searchValue = '^Draft$';
            else if (value === '0') searchValue = '^Inactive$';

            segTable.column(0).search(searchValue, true, false).draw();
        });
    }

    segTable.on('draw', renderSegPagination);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ✅ Handle View button clicks
    document.querySelectorAll('.view-subscriber').forEach(button => {
        button.addEventListener('click', function () {
            const fullName = this.dataset.full_name || '';
            const [firstName, ...lastNameParts] = fullName.split(' ');
            const lastName = lastNameParts.join(' ');

            // Fill view modal fields
            document.getElementById('modalFirstName').textContent = firstName;
            document.getElementById('modalLastName').textContent = lastName;
            document.getElementById('modalEmail').textContent = this.dataset.email;
            const status = this.dataset.status;
            const statusContainer = document.getElementById('modalStatus');
            let statusHtml = '';
            if (status == 1) statusHtml = '<span class="badge fw-normal bg-white published rounded-pill">Subscribe</span>';
            else if (status == 2) statusHtml = '<span class="badge fw-normal bg-white draft rounded-pill">Pending</span>';
            else statusHtml = '<span class="badge fw-normal bg-white inactive rounded-pill">Inactive</span>';

            statusContainer.innerHTML = statusHtml;
            document.getElementById('modalSubscribeDate').textContent = this.dataset.subscribe_date;
            document.getElementById('modalAbout').textContent = this.dataset.about;

            // ✅ Store data temporarily so Edit Modal can use same info later
            const viewModal = document.getElementById('viewSegmentation');
            viewModal.dataset.id = this.dataset.id;
            viewModal.dataset.full_name = fullName;
            viewModal.dataset.email = this.dataset.email;
            viewModal.dataset.status = this.dataset.status;
            viewModal.dataset.about = this.dataset.about;
            viewModal.dataset.subscribe_date = this.dataset.subscribe_date;
        });
    });

    // ✅ Handle Edit button clicks (in list)
    document.querySelectorAll('.edit-subscriber').forEach(button => {
        button.addEventListener('click', function () {
            const fullName = this.dataset.full_name || '';
            const [firstName, ...lastNameParts] = fullName.split(' ');
            const lastName = lastNameParts.join(' ');

            // Fill edit modal fields
            document.getElementById('editFirstName').value = firstName || '';
            document.getElementById('editLastName').value = lastName || '';
            document.getElementById('editSubscriberId').value = this.dataset.id;
            document.getElementById('editEmail').value = this.dataset.email;
            document.getElementById('editStatusSelect').value = this.dataset.status;
            document.getElementById('editAbout').value = this.dataset.about;
            document.getElementById('editSubscribeDate').value = this.dataset.subscribe_date;
        });
    });

    // ✅ Handle transition from View → Edit modal
    document.getElementById('openEditFromView').addEventListener('click', function () {
        const viewModalElement = document.getElementById('viewSegmentation');
        const viewModal = bootstrap.Modal.getInstance(viewModalElement);

        // Retrieve stored data from view modal
        const fullName = viewModalElement.dataset.full_name || '';
        const [firstName, ...lastNameParts] = fullName.split(' ');
        const lastName = lastNameParts.join(' ');

        // Fill edit modal with same data
        document.getElementById('editFirstName').value = firstName;
        document.getElementById('editLastName').value = lastName;
        document.getElementById('editSubscriberId').value = viewModalElement.dataset.id;
        document.getElementById('editEmail').value = viewModalElement.dataset.email;
        document.getElementById('editStatusSelect').value = viewModalElement.dataset.status;
        document.getElementById('editAbout').value = viewModalElement.dataset.about;
        document.getElementById('editSubscribeDate').value = viewModalElement.dataset.subscribe_date;

        // Hide view modal
        viewModal.hide();

        // Show edit modal after short delay for smooth transition
        setTimeout(() => {
            const editModal = new bootstrap.Modal(document.getElementById('editSegmentation'));
            editModal.show();
        }, 400);
    });
});
</script>



@endsection