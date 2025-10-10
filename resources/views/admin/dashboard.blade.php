@extends('layouts.admin') 

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Start Container Fluid -->
    <div class="container-fluid">

        <!-- ========== Page Title Start ========== -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="mb-0">Dashboard</h4>
                    
                </div>
            </div>
        </div>
        <!-- ========== Page Title End ========== -->

        <!-- Start here.... -->
        <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-gradient bg-success rounded">
                                            <iconify-icon icon="solar:chat-round-money-broken" class="avatar-title fs-30 text-white"></iconify-icon>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Net Revenue</p>
                                        <h3 class="text-dark mt-2 mb-0">$136.4k</h3>
                                    </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-gradient bg-info rounded">
                                            <iconify-icon icon="solar:cart-5-broken" class="avatar-title fs-30 text-white"></iconify-icon>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Orders</p>
                                        <h3 class="text-dark mt-2 mb-0">9,526</h3>
                                    </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-gradient bg-danger rounded">
                                            <iconify-icon icon="solar:users-group-two-rounded-broken" class="avatar-title fs-30 text-white"></iconify-icon>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Customers</p>
                                        <h3 class="text-dark mt-2 mb-0">{{ $client_count }}</h3>
                                    </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-gradient bg-warning rounded">
                                            <iconify-icon icon="solar:wallet-2-broken" class="avatar-title fs-30 text-white"></iconify-icon>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Balance</p>
                                        <h3 class="text-dark mt-2 mb-0">$89.6k</h3>
                                    </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Sales Report </h4>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-outline-light">ALL</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">1M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">6M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light active">1Y</button>
                                    </div>
                            </div> <!-- end card-title-->

                            <div dir="ltr">
                                    <div id="dash-performance-chart" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end right chart card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Conversions</h5>
                                    <button onclick="update()" class="btn btn-sm btn-light">Update</button>
                            </div>
                            <div id="conversions" class="apex-charts my-2"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="align-middle fw-medium">Direct Orders</span>
                                    </div>
                                    <span class="text-muted float-end">62.5%</span>
                                    <span class="badge badge-soft-danger float-end">5.06%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2">
                                    <div>
                                        <span class="align-middle fw-medium">Affiliates Orders</span>
                                    </div>
                                    <span class="text-muted float-end">12.3%</span>
                                    <span class="badge badge-soft-success float-end">1.5%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="align-middle fw-medium">Sponsored Orders</span>
                                    </div>
                                    <span class="text-muted float-end">9.86%</span>
                                    <span class="badge badge-soft-success float-end">1.03%</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- end left chart card -->
        </div> <!-- end chart card -->

        <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Recent Orders</h4>

                                    <a href="#!" class="btn btn-sm btn-primary">
                                        <i class="bx bx-plus me-1"></i>Create Order
                                    </a>
                            </div>
                        </div> <!-- end card body -->
                        <div class="table-responsive table-centered">
                            <table class="table mb-0">
                                    <thead class="bg-light bg-opacity-50">
                                        <tr>
                                            <th class="border-0 py-2">Order ID.</th>
                                            <th class="border-0 py-2">Date</th>
                                            <th class="border-0 py-2">Customer Name</th>
                                            <th class="border-0 py-2">Email ID</th>
                                            <th class="border-0 py-2">Phone No.</th>
                                            <th class="border-0 py-2">Address</th>
                                            <th class="border-0 py-2">Payment Type</th>
                                            <th class="border-0 py-2">Status</th>
                                        </tr>
                                    </thead> <!-- end thead-->
                                    <tbody>
                                        <tr>
                                            <td><a href="#!">#TZ5625</a></td>
                                            <td>29 April 2024</td>
                                            <td><a href="#!">Anna M. Hines</a></td>
                                            <td>anna.hines@mail.com</td>
                                            <td>(+1)-555-1564-261</td>
                                            <td>Burr Ridge/Illinois</td>
                                            <td>Credit Card</td>
                                            <td><i class="bx bxs-circle text-success me-1"></i>Completed</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#!">#TZ9652</a></td>
                                            <td>25 April 2024</td>
                                            <td><a href="#!">Judith H. Fritsche</a></td>
                                            <td>judith.fritsche.com</td>
                                            <td>(+57)-305-5579-759</td>
                                            <td>SULLIVAN/Kentucky</td>
                                            <td>Credit Card</td>
                                            <td><i class="bx bxs-circle text-success me-1"></i>Completed</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#!">#TZ5984</a></td>
                                            <td>25 April 2024</td>
                                            <td><a href="#!">Peter T. Smith</a></td>
                                            <td>peter.smith@mail.com</td>
                                            <td>(+33)-655-5187-93</td>
                                            <td>Yreka/California</td>
                                            <td>Pay Pal</td>
                                            <td><i class="bx bxs-circle text-success me-1"></i>Completed</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#!">#TZ3625</a></td>
                                            <td>21 April 2024</td>
                                            <td><a href="#!">Emmanuel J. Delcid</a></td>
                                            <td>emmanuel.delicid@mail.com</td>
                                            <td>(+30)-693-5553-637</td>
                                            <td>Atlanta/Georgia</td>
                                            <td>Pay Pal</td>
                                            <td><i class="bx bxs-circle text-primary me-1"></i>Processing</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#!">#TZ8652</a></td>
                                            <td>18 April 2024</td>
                                            <td><a href="#!">William J. Cook</a></td>
                                            <td>william.cook@mail.com</td>
                                            <td>(+91)-855-5446-150</td>
                                            <td>Rosenberg/Texas</td>
                                            <td>Credit Card</td>
                                            <td><i class="bx bxs-circle text-primary me-1"></i>Processing</td>
                                        </tr>
                                    </tbody> <!-- end tbody -->
                            </table> <!-- end table -->
                        </div> <!-- table responsive -->
                        <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                            <div class="col-sm">
                                    <div class="text-muted">
                                        Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">90,521</span> orders
                                    </div>
                            </div>
                            <div class="col-sm-auto mt-3 mt-sm-0">
                                    <ul class="pagination pagination-rounded m-0">
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class='bx bx-left-arrow-alt'></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class='bx bx-right-arrow-alt'></i></a>
                                        </li>
                                    </ul>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">New Accounts</h4>
                            <a href="#!" class="btn btn-sm btn-light">
                                    View All
                            </a>
                        </div> <!-- end card-header-->

                        <div class="card-body pb-1">
                            <div class="table-responsive">
                                    <table class="table table-hover mb-0 table-centered">
                                        <thead>
                                            <th class="py-1">ID</th>
                                            <th class="py-1">Date</th>
                                            <th class="py-1">User</th>
                                            <th class="py-1">Account</th>
                                            <th class="py-1">Username</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#US523</td>
                                                <td>24 April, 2024</td>
                                                <td><img src="{{ asset('assets/admin/images/users/avatar-2.jpg') }}" alt="avatar-2" class="img-fluid avatar-xs rounded-circle"> <span class="align-middle ms-1">Dan Adrick</span></td>
                                                <td><span class="badge badge-soft-success">Verified</span></td>
                                                <td>@omions </td>
                                            </tr>
                                            <tr>
                                                <td>#US652</td>
                                                <td>24 April, 2024</td>
                                                <td><img src="{{ asset('assets/admin/images/users/avatar-3.jpg') }}" alt="avatar-2" class="img-fluid avatar-xs rounded-circle"> <span class="align-middle ms-1">Daniel Olsen</span></td>
                                                <td><span class="badge badge-soft-success">Verified</span></td>
                                                <td>@alliates </td>
                                            </tr>
                                            <tr>
                                                <td>#US862</td>
                                                <td>20 April, 2024</td>
                                                <td><img src="{{ asset('assets/admin/images/users/avatar-4.jpg') }}" alt="avatar-2" class="img-fluid avatar-xs rounded-circle"> <span class="align-middle ms-1">Jack Roldan</span></td>
                                                <td><span class="badge badge-soft-warning">Pending</span></td>
                                                <td>@griys </td>
                                            </tr>
                                            <tr>
                                                <td>#US756</td>
                                                <td>18 April, 2024</td>
                                                <td><img src="{{ asset('assets/admin/images/users/avatar-5.jpg') }}" alt="avatar-2" class="img-fluid avatar-xs rounded-circle"> <span class="align-middle ms-1">Betty Cox</span></td>
                                                <td><span class="badge badge-soft-success">Verified</span></td>
                                                <td>@reffon </td>
                                            </tr>
                                            <tr>
                                                <td>#US420</td>
                                                <td>18 April, 2024</td>
                                                <td><img src="{{ asset('assets/admin/images/users/avatar-6.jpg') }}" alt="avatar-2" class="img-fluid avatar-xs rounded-circle"> <span class="align-middle ms-1">Carlos Johnson</span></td>
                                                <td><span class="badge badge-soft-danger">Blocked</span></td>
                                                <td>@bebo </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Recent Transactions</h4>

                            <a href="#!" class="btn btn-sm btn-light">
                                    View All
                            </a>
                        </div> <!-- end card-header-->

                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-hover mb-0 table-centered">
                                        <thead>
                                            <th class="py-1">ID</th>
                                            <th class="py-1">Date</th>
                                            <th class="py-1">Amount</th>
                                            <th class="py-1">Status</th>
                                            <th class="py-1">Description</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#98521</td>
                                                <td>24 April, 2024</td>
                                                <td>$120.55</td>
                                                <td><span class="badge bg-success">Cr</span></td>
                                                <td>Commisions </td>
                                            </tr>
                                            <tr>
                                                <td>#20158</td>
                                                <td>24 April, 2024</td>
                                                <td>$9.68</td>
                                                <td><span class="badge bg-success">Cr</span></td>
                                                <td>Affiliates </td>
                                            </tr>
                                            <tr>
                                                <td>#36589</td>
                                                <td>20 April, 2024</td>
                                                <td>$105.22</td>
                                                <td><span class="badge bg-danger">Dr</span></td>
                                                <td>Grocery </td>
                                            </tr>
                                            <tr>
                                                <td>#95362</td>
                                                <td>18 April, 2024</td>
                                                <td>$80.59</td>
                                                <td><span class="badge bg-success">Cr</span></td>
                                                <td>Refunds </td>
                                            </tr>
                                            <tr>
                                                <td>#75214</td>
                                                <td>18 April, 2024</td>
                                                <td>$750.95</td>
                                                <td><span class="badge bg-danger">Dr</span></td>
                                                <td>Bill Payments </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
        </div> <!-- end row -->

    </div>
    <!-- End Container Fluid -->
@endsection