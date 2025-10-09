@extends('layouts.admin') {{-- agar layouts/admin.blade.php hai --}}

@section('title', 'Clients')

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
        <div class="col-6 col-md-6">
            <div class="page-title-box">
                <h4 class="mb-0">Admin User</h4>
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="page-title-box justify-content-end">
                <button type="button" class="btn btn-dark btn-md" data-bs-toggle="modal" data-bs-target="#addAdmin">Add New Admin <iconify-icon icon="mingcute:plus-fill" class="align-middle text-right"></iconify-icon></button>
            </div>
        </div>
    </div>
    <!-- ========== Page Title End ========== -->

    <!-- Start here.... -->
    <div class="row">
            <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <div class="py-3">
                    <div id="table-admin-users"></div>
                </div>

                <div class="highlight border rounded">
                </div>
            </div>
        </div>
            </div>
    </div>



</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    new gridjs.Grid({
        columns: [
            "ID",
            "Name",
            "Email",
            "Status",
            {
                name: "Action",
                formatter: (_, row) => {
                    return gridjs.html(`
                        <span>
                            <button type="button" class="btn btn-dark btn-md">Reset Password <iconify-icon icon="ri:reset-left-line" class="align-middle"></iconify-icon>
                            </button> 
                            <button type="button" class="btn btn-dark btn-md">Delete <iconify-icon icon="fa6-solid:trash" class="align-middle"></iconify-icon>
                            </button>
                        </span>
                    `);
                }
            }
        ],
        data: [
            @foreach($adminUsers as $user)
            [
                "{{ $user->id }}",
                "{{ $user->first_name }}",
                "{{ $user->email }}",
                gridjs.html(`
                        <span class="badge 
                            @if($user->status == 1) bg-success
                            @elseif($user->status == 0) bg-dark
                            @elseif($user->status == 2) bg-danger
                            @endif">
                            @if($user->status == 1) Active
                            @elseif($user->status == 0) Inactive
                            @elseif($user->status == 2) Pending
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
        className: {
            table: 'table table-bordered table-striped',
        }
    }).render(document.getElementById("table-admin-users"));
});
</script>

@endsection