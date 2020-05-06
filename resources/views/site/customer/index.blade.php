@extends('site.main')

@section('content')
@include('site.elements.breadcumb', [$breadcumb, $title])
<!-- My Account Section Start -->
<div class="section section-padding">
    <div class="container">
        <div class="row mbn-30">

            <!-- My Account Tab Menu Start -->
            <div class="col-lg-3 col-12 mb-30">
                <div class="myaccount-tab-menu nav" role="tablist">

                    <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

                    <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>

                    <a href="{{ url('customer/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </div>
            <!-- My Account Tab Menu End -->

            <!-- My Account Tab Content Start -->
            <div class="col-lg-9 col-12 mb-30">
                <div class="tab-content" id="myaccountContent">

                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade active" id="orders" role="tabpanel">
                        <div class="myaccount-content">
                            <h3>Orders</h3>

                            <div class="myaccount-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Moisturizing Oil</td>
                                            <td>Aug 22, 2018</td>
                                            <td>Pending</td>
                                            <td>$45</td>
                                            <td><a href="cart.html" class="btn">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Katopeno Altuni</td>
                                            <td>July 22, 2018</td>
                                            <td>Approved</td>
                                            <td>$100</td>
                                            <td><a href="cart.html" class="btn">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Murikhete Paris</td>
                                            <td>June 12, 2017</td>
                                            <td>On Hold</td>
                                            <td>$99</td>
                                            <td><a href="cart.html" class="btn">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Single Tab Content End -->

                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                        <div class="myaccount-content">
                            <h3>Account Details</h3>

                            <div class="account-details-form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="first-name" placeholder="First Name" type="text">
                                        </div>

                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="last-name" placeholder="Last Name" type="text">
                                        </div>

                                        <div class="col-12 mb-30">
                                            <input id="display-name" placeholder="Display Name" type="text">
                                        </div>

                                        <div class="col-12 mb-30">
                                            <input id="email" placeholder="Email Address" type="email">
                                        </div>

                                        <div class="col-12 mb-30">
                                            <h4>Password change</h4>
                                        </div>

                                        <div class="col-12 mb-30">
                                            <input id="current-pwd" placeholder="Current Password" type="password">
                                        </div>

                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="new-pwd" placeholder="New Password" type="password">
                                        </div>

                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="confirm-pwd" placeholder="Confirm Password" type="password">
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-round btn-lg">Save Changes</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Single Tab Content End -->
                </div>
            </div>
            <!-- My Account Tab Content End -->
        </div>
    </div>
</div><!-- My Account Section End -->
@endsection