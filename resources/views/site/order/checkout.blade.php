@extends('site.main')

@section('content')
@include('site.elements.breadcumb', [$breadcumb, $title])
<!-- Checkout Section Start -->
<div class="section section-padding">
    <div class="container">
        <div class="row">
            @if(!Cart::isEmpty())
                <div class="col-12">

                    <!-- Checkout Form Start-->
                <form action="{{ url('order/checkout') }}" method="POST" class="checkout-form">
                        <div class="row mbn-40">

                            <div class="col-lg-7 mb-40">

                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-10">
                                    <h4 class="checkout-title">Billing Address</h4>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="row mbn-30">                               
                                        <div class="col-12 mb-50">
                                            <label>Tên</label>
                                            <input type="text" name="name" placeholder="Company Name">
                                        </div>

                                    </div>
                                    
                                    <div class="row mbn-30">                               
                                        <div class="col-12 mb-50">
                                            <label>Email</label>
                                            <input type="text"  name="email" placeholder="Company Name">
                                        </div>

                                    </div>
                                    
                                    <div class="row mbn-30">                               
                                        <div class="col-12 mb-50">
                                            <label>Điện thoại</label>
                                            <input type="text" name="phone" placeholder="Company Name">
                                        </div>

                                    </div>
                                    
                                    <div class="row mbn-30">                               
                                        <div class="col-12 mb-50">
                                            <label>Địa chỉ</label>
                                            <input type="text" name="address"  placeholder="Company Name">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-5 mb-40">
                                <div class="row">

                                    <!-- Cart Total -->
                                    <div class="col-12 mb-30">

                                        <h4 class="checkout-title">Cart Total</h4>

                                        <div class="checkout-cart-total">

                                            <h4>Product <span>Total</span></h4>

                                            <ul>                                            
                                                    @forEach(Cart::getContent() as $key => $item)
                                                        <li>{{ $item->name }} X {{ $item->quantity }} <span>{{ fotmatPrice(($item->price)*($item->quantity)) }}</span></li>
                                                    @endForeach
                                            </ul>
                                            <h4>Grand Total <span>{{ fotmatPrice(Cart::getTotal()) }}‬</span></h4>

                                        </div>

                                    </div>

                                    <!-- Payment Method -->
                                    <div class="col-12">

                                        <button class="place-order btn" type="submit">Place order</button>

                                    </div>

                                </div>
                            </div>

                        </div>
                </form><!-- Checkout Form End-->

                </div>
            @else
                <div>Không có sản phẩm nào trong giỏ hàng</div>
             @endIf
        </div>
    </div>
</div><!-- Checkout Section End -->


@endsection