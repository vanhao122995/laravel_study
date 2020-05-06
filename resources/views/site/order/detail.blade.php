@extends('admin.main')

@section('content')
<?php
    $prefix = 'order';
    $name_item   = 'đơn hàng';
?>
<style>
    /*Checkout Cart Total*/
    .checkout-cart-total {
    background-color: #eeeeee;
    padding: 45px;
    }

    .checkout-cart-total h4 {
    -webkit-flex-basis: 18px;
        -ms-flex-preferred-size: 18px;
            flex-basis: 18px;
    line-height: 1;
    font-weight: 700;
    }

    .checkout-cart-total h4:first-child {
    margin-top: 0;
    margin-bottom: 25px;
    }

    .checkout-cart-total h4:last-child {
    margin-top: 15px;
    margin-bottom: 0;
    }

    .checkout-cart-total h4 span {
    float: right;
    display: block;
    }

    .checkout-cart-total ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
    border-bottom: 1px solid #c0c0c0;
    }

    .checkout-cart-total ul li {
    font-size: 14px;
    line-height: 23px;
    font-weight: 600;
    display: block;
    margin-bottom: 16px;
    }

    .checkout-cart-total ul li span {
    float: right;
    }

    .checkout-cart-total p {
    font-size: 14px;
    line-height: 30px;
    font-weight: 600;
    padding: 10px 0;
    border-bottom: 1px solid #c0c0c0;
    margin: 0;
    }

    .checkout-cart-total p span {
    float: right;
    }

    @media only screen and (max-width: 575px) {
    .checkout-cart-total {
        padding: 30px;
    }
    }
</style>
@include('site.elements.breadcumb', [$breadcumb, $title])
<div class="products">
        <div class="panel-action">
            <div class="row">
                <div class="products-act">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="left-action text-left clearfix">
                            <h2><i class="fa fa-refresh" style="font-size: 14px; cursor: pointer;"></i>{{ $title }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-action text-right">
                            <div class="btn-groups">
                                <a href="{{ url("admin/{$prefix}") }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Trở về</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-space customer"></div>

        <div class="products-content" style="margin-bottom: 25px;">
            <div class="basic-info">
                <div class="row">
                    <div class="col-md-10">
                        <div class="checkout-cart-total">
                            <h4>Product <span>Total</span></h4>
                            <ul>
                                @if($items)
                                    <?php $total = 0; ?>
                                    @forEach($items as $key => $item)
                                        <?php $total += ($item->price)*($item->quantity); ?>
                                        <li>{{ $item->product->name }} X {{ $item->quantity }} <span>{{ fotmatPrice(($item->price)*($item->quantity)) }}</span></li>
                                    @endForeach
                                @endIf
                            </ul>
                            <h4>Total <span>{{ fotmatPrice($total) }}‬</span></h4>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
</div>
@endsection