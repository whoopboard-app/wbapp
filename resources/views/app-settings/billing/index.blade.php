@extends('layouts.app')

@section('content')
<style>
    .modal-body{
        padding-top:2rem;
    }
    .para {
        font-size: 15px !important;
    }
    .let_spc{
        letter-spacing: 0.4px !important;
    }.input-field{
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
    .label {
        font-size: 15px;
    }
    main.flex-1.p-8.pb-48{
        padding-top : 0px !important;
        padding-left : 0px !important;
        padding-right : 0px !important;
    }
    .col-sm-12{
        padding-left : 0px !important;
        padding-right : 0px !important;

    }
    div#billingHistory_filter{
        Display : none;
    }

    .card.card-badge {
        border: 1px solid #7FBAFF;
        background-color: #F2F8FF;
    }

    @media (min-width: 992px) {
        .section-content-center {
            max-width: 898px;

        }
    }
</style>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif

<section class="section-content-center my-profile-wrapper main-content-wrapper">
        <div class="d-flex justify-content-start">
            <h4 class="fw-medium font-16 mb-0">Billings & Subscriptions</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-2">
                <a href="{{route('app.settings')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2 position-absolute" style="right: 40px;">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to Listing Page
                </a>
            </div>
        </div>
    <div class="d-inline-block w-100 mt-10px">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="history-tab" data-bs-toggle="pill" data-bs-target="#history-data" type="button" role="tab" aria-controls="history-data" aria-selected="true">Billing History</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="subscribe-tab" data-bs-toggle="pill" data-bs-target="#subscribe-data" type="button" role="tab" aria-controls="subscribe-data" aria-selected="false" tabindex="-1">My Subscriptions (Plan Details)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="delete-tab" data-bs-toggle="pill" data-bs-target="#delete-data" type="button" role="tab" aria-controls="delete-data" aria-selected="false" tabindex="-1">Delete Account</button>
            </li>

        </ul>

    </div>
    <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="history-data" role="tabpanel" aria-labelledby="history-tab">
                <div class="row mt-20 card pt-0 px-0 bg-white mb-3">
                    <div class="d-flex border-title align-items-center justify-content-between flex-wrap py-2 px-3 bg-white rounded">
                        <h4 class="fw-medium mb-0">{{ $count }} Billing History</h4>

                        <!-- ✅ Custom Search -->
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap-3 flex-wrap mb-0">
                            <div class="position-relative form-group mb-0">
                                <input type="search" id="customSearch" class="input-field w-100 rounded ps-5" placeholder="Search">
                                <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="billingHistory" class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="10%">Status</th>
                                    <th width="18%">Invoice Number</th>
                                    <th width="18%">Plan Name</th>
                                    <th width="10%">Amount</th>
                                    <th width="17%">Transaction ID</th>
                                    <!-- <th width="10%">Type</th> -->
                                    <th width="30%">Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($planTransactions as $transaction)
                                    <tr>
                                        <td>
                                            @if ($transaction->status == 1)
                                                <span class="badge fw-normal bg-white active rounded-pill">Paid</span>
                                            @elseif ($transaction->status == 2)
                                                <span class="badge fw-normal bg-white scheduled rounded-pill">Pending</span>
                                            @else
                                                <span class="badge fw-normal bg-white rounded-pill">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#">#{{ $transaction->invoice_number }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $transaction->membershipPlan->name ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <span>$ {{ $transaction->amount }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $transaction->transaction_id ?? '-' }}</span>
                                        </td>
                                        <!-- <td>
                                            <span>{{ ucfirst($transaction->payment_type ?? '-') }}</span>
                                        </td> -->
                                        <td>
                                            <span>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('F d, Y \a\t h:i A') }}</span>
                                        </td>
                                        <td>
                                            <div class="icon-box d-flex align-items-center gap-2">
                                                <a href="#"><img src="{{ asset('assets/img/icon/edit.svg') }}" alt="" style="max-width:15px;"></a>
                                                <div class="divider"></div>
                                                <a href="#"><img src="{{ asset('assets/img/icon/oval.svg') }}" alt="" style="max-width:15px;"></a>
                                                <div class="divider"></div>
                                                <a href="#"><img src="{{ asset('assets/img/icon/trash.svg') }}" alt="" style="max-width:15px;"></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="customPagination" class="d-flex align-items-center gap-3 p-3 pt-0 pagination bg-white border-bottom"></div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="subscribe-data" role="tabpanel" aria-labelledby="subscribe-tab">
                <div class="row mt-20">
                    <div class="col-lg-12 view-changelog-details">
                        <div class="card p-0 bg-white mb-3">
                                    <form action="#" class=" form">
                                <div class="d-flex align-items-center border-title justify-content-between">
                                    <h4 class="fw-medium mb-0">Your Plan</h4>

                                </div>
                                <div class="mx-auto p-3">
                                     <div class="basic-information">
                                       <p class="label color-support fw-medium my-2">
                                        Create and organize categories to group your product updates. Categories make it easier for users to browse updates by topic or type.
                                       </p>
                                       <div class="card card-badge modal-note-card mb-2">
                                            <p class="mb-0 fw-medium text-primary label">
                                                You can rename modules to match your business language. For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                                            </p>
                                        </div>
                                        <h5 class="fw-semibold font-18 mt-10px">
                                            {{ $currentPlan ? $currentPlan->name : 'No Plan Selected' }}
                                        </h5>
                                        <p class="label text-black mt-2">
                                            @if($currentPlan)
                                                You’re currently on our <strong>{{ $currentPlan->name }}</strong>.
                                                Update plan has even more features to help you do your best work.
                                                {{ $currentPlan->description }}
                                            @else
                                                You currently have no active plan.
                                            @endif


                                        </p>
                                        <ul style="padding-inline-start: 40px;">
                                            <li class="list-type-disc label">
                                                Change Logs: {{ $currentPlan ? $currentPlan->total_change_logs : 0 }}
                                            </li>
                                            <li class="list-type-disc label">
                                                Knowledge Boards: {{ $currentPlan ? $currentPlan->total_knowledge_boards : 0 }}
                                            </li>
                                            <li class="list-type-disc label">
                                                Email Sending Limit: {{ $currentPlan ? $currentPlan->email_sending_limit : 0 }}
                                            </li>
                                        </ul>
                                        @foreach($plans as $plan)
                                            @if($plan->id > $currentPlan->id)
                                                <!-- Enable button for higher plans -->
                                                <a
                                                    class="theme-btn sm fw-semibold mt-10px d-inline-block rounded openPlanModal cursor-pointer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updatePlan"
                                                    data-id="{{ $plan->id }}"
                                                    data-name="{{ $plan->name }}"
                                                    data-price-month="{{ $plan->price_1_month }}"
                                                    data-price-annual="{{ $plan->price_12_month }}"
                                                    data-description="{{ $plan->description }}"
                                                    data-changelogs="{{ $plan->total_change_logs }}"
                                                    data-knowledge="{{ $plan->total_knowledge_boards }}"
                                                    data-email="{{ $plan->email_sending_limit }}"
                                                >
                                                    Upgrade to {{ $plan->name }}
                                                </a>
                                            @else
                                                @if(!$loop->first)
                                                    <!-- Show disabled button for lower/same plans -->
                                                    <button
                                                        class="theme-btn sm fw-semibold mt-10px d-inline-block rounded cursor-not-allowed opacity-50"
                                                        disabled
                                                    >
                                                        {{ $plan->name }}
                                                    </button>
                                                @endif
                                            @endif
                                        @endforeach



                                     </div>



                                </div>
                            <div class="card-footer gap15 px-3 bg-light min-height-66 d-flex justify-content-start">

                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="delete-data" role="tabpanel" aria-labelledby="delete-tab">
                <div class="row mt-20">
                    <div class="col-lg-12 view-changelog-details">
                        <div class="card p-0 bg-white mb-3">

                                    <div class="d-flex align-items-center border-title justify-content-between">
                                        <h4 class="fw-medium mb-0">Delete</h4>
                                    </div>
                                    <div class="mx-auto p-3">
                                        <div class="basic-information">
                                            <p class="label color-support fw-medium my-2">
                                                Create and organize categories to group your product updates. Categories make it easier for users to browse updates by topic or type.
                                            </p>
                                            <div class="card card-badge modal-note-card mb-2">
                                                <p class="mb-0 fw-medium text-primary label">
                                                    You can rename modules to match your business language. For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                                                </p>
                                            </div>
                                        </div>
                                        <h5 class="fw-semibold font-18 mt-10px">Here’s what you should know before you cancel</h5>
                                        <p class="label text-black fw-normal  mt-10px">
                                            Your’re currently on our FREE PLAN. Whoopboard premium has even more features to help you do you best work.
                                        </p>
                                        <ul style="padding-inline-start: 40px;">
                                            <li class="list-type-disc label">
                                                Unlimited reminders
                                            </li>
                                            <li class="list-type-disc label">
                                                Lable, filters, comments
                                            </li>
                                            <li class="list-type-disc label">
                                                10+ themes and more
                                            </li>
                                        </ul>
                                        <form action="{{ route('billing.delete') }}" method="POST">
                                            @csrf
                                            <h6 class="label fw-normal mt-20 mb-2">Reason for Cancellation</h6>

                                            <div class="reason-option mb-2">
                                                <input type="radio" name="reason" id="reason1" value="Reason Code 1" required>
                                                <label for="reason1" class="mb-0">Reason Code 1</label>
                                            </div>
                                            <div class="reason-option mb-2">
                                                <input type="radio" name="reason" id="reason2" value="Reason Code 2">
                                                <label for="reason2" class="mb-0">Reason Code 2</label>
                                            </div>
                                            <div class="reason-option mb-2">
                                                <input type="radio" name="reason" id="reason3" value="Reason Code 3">
                                                <label for="reason3" class="mb-0">Reason Code 3</label>
                                            </div>
                                            <div class="reason-option mb-2">
                                                <input type="radio" name="reason" id="reason4" value="Reason Code 4">
                                                <label for="reason4" class="mb-0">Reason Code 4</label>
                                            </div>

                                            <div class="card-footer gap15 px-3 bg-light d-flex justify-content-start">
                                                <button type="submit" class="theme-btn sm fw-normal font-12 d-inline-block rounded" style="background-color: #FE3819;">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>

                        </div>
                    </div>

                </div>
            </div>
    </div>

</section>
 <!-- Modal -->
<div class="modal fade" id="updatePlan" tabindex="-1" aria-labelledby="updatePlanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="fw-semibold mb-0 fs-3">Upgrade Plan</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body py-4">
            <h5 class="font-18 fw-semibold mb-2" id="planName">-</h5>
            <p class="label text-black fw-normal" id="planDescription">
                -
            </p>
            <ul style="padding-inline-start: 40px;">
                <li class="list-type-disc label" id="planChangeLogs">- Change Logs</li>
                <li class="list-type-disc label" id="planKnowledgeBoards">- Knowledge Boards</li>
                <li class="list-type-disc label" id="planEmailLimit">- Email Sending Limit</li>
            </ul>
            <div class="toggle-btn-group mt-10px">
                <button class="toggle-btn label fw-semibold active" id="perMonthBtn">Per month</button>
                <button class="toggle-btn label fw-semibold" id="annualPlanBtn">Annual Plan</button>
            </div>
            <h5 class="fw-semibold font-24 mt-10px" id="planPrice">$ -</h5>
        </div>

        <!-- Modal Footer -->
            <form action="{{ route('billing.upgrade') }}" method="POST">
                @csrf
                <input type="hidden" name="plan_id" id="selectedPlanId">

                <div class="modal-footer justify-content-start border-top-0">
                    <button type="submit" class="theme-btn fw-semibold rounded border-0">Upgrade &amp; Continue</button>
                    <button type="button" class="theme-btn secondary fw-semibold rounded" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- ✅ DataTables JS (CDN version) -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ✅ Initialize DataTable and assign it to a variable
    let table = $('#billingHistory').DataTable({
        ordering: false,
        pageLength: 5,
        lengthChange: false, // hide "Show entries"
        info: false,         // hide "Showing X of Y"
        searching: true,    // hide default search
        paging: true,
        dom: 't',
    });

    const paginationContainer = document.querySelector('#customPagination');

    function renderPagination() {
        const pageInfo = table.page.info();
        const currentPage = pageInfo.page + 1;
        const totalPages = pageInfo.pages;

        let html = '';

        // Previous button
        if(currentPage > 1) {
            html += `<a href="#" class="prev fw-semibold rounded sm" data-page="${currentPage-1}">&lt; Previous</a>`;
        }

        // Page numbers
        html += `<div class="page-numbers d-flex align-items-center gap-2">`;
        for(let i=1; i<=totalPages; i++) {
            html += `<a href="#" class="pagination-number ${i===currentPage?'active':''}" data-page="${i}">${i}</a>`;
        }
        html += `</div>`;

        // Next button
        if(currentPage < totalPages) {
            html += `<a href="#" class="next fw-semibold rounded sm" data-page="${currentPage+1}">Next &gt;</a>`;
        }

        paginationContainer.innerHTML = html;

        // Click events
        paginationContainer.querySelectorAll('a[data-page]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const page = parseInt(this.getAttribute('data-page')) - 1;
                table.page(page).draw('page');
                renderPagination();
            });
        });
    }

    renderPagination();

    // Connect your custom search input
    let customSearch = document.querySelector('#customSearch');
    if (customSearch) {
        customSearch.addEventListener('input', function() {
            table.search(this.value).draw();
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPlan = {};

    document.querySelectorAll('.openPlanModal').forEach(button => {
        button.addEventListener('click', function() {
            currentPlan = {
                id: this.dataset.id,
                name: this.dataset.name,
                description: this.dataset.description,
                monthPrice: parseFloat(this.dataset.priceMonth),
                annualPrice: parseFloat(this.dataset.priceAnnual),
                changeLogs: this.dataset.changelogs,
                knowledgeBoards: this.dataset.knowledge,
                emailLimit: this.dataset.email
            };

            document.getElementById('selectedPlanId').value = currentPlan.id;
            // Populate modal content
            document.getElementById('planName').textContent = currentPlan.name;
            document.getElementById('planDescription').textContent = currentPlan.description;
            document.getElementById('planChangeLogs').textContent = currentPlan.changeLogs + ' Change Logs';
            document.getElementById('planKnowledgeBoards').textContent = currentPlan.knowledgeBoards + ' Knowledge Boards';
            document.getElementById('planEmailLimit').textContent = currentPlan.emailLimit + ' Emails';
            document.getElementById('planPrice').textContent = `$${currentPlan.monthPrice.toFixed(2)}`;

            // Set active toggle
            document.getElementById('perMonthBtn').classList.add('active');
            document.getElementById('annualPlanBtn').classList.remove('active');
        });
    });

    const perMonthBtn = document.getElementById('perMonthBtn');
    const annualBtn = document.getElementById('annualPlanBtn');
    const planPrice = document.getElementById('planPrice');

    perMonthBtn.addEventListener('click', function() {
        perMonthBtn.classList.add('active');
        annualBtn.classList.remove('active');
        planPrice.textContent = `$${currentPlan.monthPrice.toFixed(2)}`;
    });

    annualBtn.addEventListener('click', function() {
        annualBtn.classList.add('active');
        perMonthBtn.classList.remove('active');
        planPrice.textContent = `$${currentPlan.annualPrice.toFixed(2)}`;
    });
});


</script>
@endpush

@push('styles')
<!-- ✅ DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

