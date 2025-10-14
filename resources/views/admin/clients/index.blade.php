@extends('layouts.admin') 

@section('title', 'Back Office')

@section('content')
<style>
    th.gridjs-th {
        border-top: 0;
        color: var(--bs-body-color);
        background-color: rgba(var(--bs-light-rgb), .85);
        font-weight: 600;
        padding: 12px 16px;
        text-transform: capitalize;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    .gridjs-search::before {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
    }

    .gridjs-search input.gridjs-input {
        padding-left: 35px !important; /* space for icon */
        border: 1px solid #ccc;
        border-radius: 5px;
        height: 36px;
        font-size: 14px;
    }
    .gridjs-table td,
    .gridjs-table th {
        vertical-align: middle !important;
    }
    .gridjs-pagination .gridjs-pages button.gridjs-currentPage {
        background-color: #4697ce;
        color: #fff;
        border-color: #4697ce;
        font-weight: 500;
    }
</style>
 <div class="container-fluid">

    <!-- ========== Page Title Start ========== -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0">Clients</h4>
                
            </div>
        </div>
    </div>
    <!-- ========== Page Title End ========== -->

    <!-- Start here.... -->
    <div class="row">
            <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <div class="py-2">
                    <div id="table-clients"></div>
                </div>

                <div class="highlight border rounded">
                </div>
            </div>
        </div>
            </div>
    </div>



</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    new gridjs.Grid({
        columns: [
            "ID",
            "First Name",
            "Last Name",
            "Email Address",
            "Registration Date",
            "Billing",
            "Status",
            {
                name: "Action",
                formatter: (_, row) => {
                    return gridjs.html(`
                        <button type="button" class="btn btn-dark btn-sm rounded">View Info <iconify-icon icon="carbon:view-filled" class="align-middle"></iconify-icon></button>
                    `);
                }
            }
        ],
        data: [
            @foreach($clients as $client)
                [
                    "{{ $client->id }}",
                    "{{ $client->name }}",
                    "{{ $client->last_name }}",
                    "{{ $client->email }}",
                    "{{ $client->created_at->format('F d, Y') }}",
                    gridjs.html("<strong>{{ $client->billing ?? 'Free' }}</strong>"),
                    gridjs.html(`
                        <span class="badge 
                            @if($client->status == 1) bg-success
                            @elseif($client->status == 2) bg-dark
                            @elseif($client->status == 3) bg-danger
                            @endif">
                            @if($client->status == 1) Active
                            @elseif($client->status == 2) Inactive
                            @elseif($client->status == 3) Pending
                            @endif
                        </span>
                    `),
                ],
            @endforeach
        ],
        search: true,
        pagination: {
            enabled: true,
            limit: 5
        },
        sort: false,
        className: {
            table: 'table table-bordered table-striped',
        }
    }).render(document.getElementById("table-clients"));
});
</script>
@endsection