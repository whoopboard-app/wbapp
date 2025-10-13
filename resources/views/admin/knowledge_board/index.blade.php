@extends('layouts.admin') {{-- agar layouts/admin.blade.php hai --}}

<!-- @section('title', 'Clients') -->

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
    <!-- Start Container Fluid -->
    <div class="container-fluid">

        <!-- ========== Page Title Start ========== -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="mb-0">Knowledge Board</h4>
                    
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
                        <div id="table-knowledge_board"></div>
                    </div>

                    <div class="highlight border rounded">
                    </div>
                </div>
            </div>
                </div>
        </div>



    </div>
    <!-- End Container Fluid -->

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const boards = @json($boards);

                new gridjs.Grid({
                    columns: [
                        { id: 'id', name: 'ID' },
                        { id: 'name', name: 'Knowledge Board' },
                        { id: 'clientName', name: 'Client Name' },
                        {
                            id: 'action',
                            name: 'Action',
                            formatter: (cell, row) => gridjs.html(
                                `<button type="button" class="btn btn-dark btn-md">
                                    View Board <iconify-icon icon="carbon:view-filled" class="align-middle"></iconify-icon>
                                </button>`
                            )
                        }
                    ],
                    data: boards.map(a => [
                        `#${a.id}`,
                        a.name,
                        a.client ? `${a.client.first_name} ${a.client.last_name}` : 'N/A',
                        ''
                    ]),
                    search: true,
                    sort: false,
                    pagination: {
                        enabled: true,
                        limit: 5,
                    },
                    className: {
                        table: 'table table-hover mb-0 table-centered'
                    }
                }).render(document.getElementById('table-knowledge_board'));
            });
        </script>
     
@endsection