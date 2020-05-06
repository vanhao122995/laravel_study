@extends('site.main')

@section('content')
<?php
    $prefix = 'order';
    $name_item = 'đơn hàng';
?>
@include('site.elements.breadcumb', [$breadcumb, $title])
<!-- Cart Section Start -->
<div class="section section-padding">
    <form action="{{ url("order/cart/update") }}" method="POST">
    <div class="container">
        <div class="row">
            @if(!Cart::isEmpty())
            
                <div class="col-12">
                    <!--Cart Table Start-->
                    
                        <div class="cart-table table-responsive mb-30">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $xhtml = '';
                                        foreach (Cart::getContent() as $key => $item) {
                                            $image = url('uploads/admin/product') . '/' . $item->attributes->image;
                                            $url_delete = url("order/cart/delete/{$item->id}");
                                            $xhtml .= '<tr>
                                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                                        <input type="hidden" name="id[]" value="'.$item->id.'">
                                                        <td><a href="single-product.html"><img width="100" heigh="100" src="'.$image.'" alt="Product"></a></td>
                                                        <td><a href="single-product.html">'.$item->name.'</a></td>
                                                        <td><span>'. fotmatPrice($item->price) .'</span></td>
                                                        <td>
                                                            <div class="pro-qty"><input type="text" name="qty[]" value="'.$item->quantity.'"></div>
                                                        </td>
                                                        <td><span>'. fotmatPrice($item->price * $item->quantity) .'</span></td>
                                                        <td><a href="'.$url_delete.'"><i class="fa fa-trash-o"></i></a></td>
                                                    </tr>';
                                        }
                                        echo $xhtml;
                                    ?>                             
                                </tbody>
                            </table>
                        </div>
                    
                    <!--Cart Table End-->

                    <div class="row mbn-40">
                        <!--Cart Summary Start-->
                        <div class="col-lg-6 col-12 mb-40">
                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4>Cart Summary</h4>
                                    <h5>Grand Total <span>{{ fotmatPrice(Cart::getTotal()) }}</span></h5>
                                </div>
                                <div class="cart-summary-button">
                                    <a href="{{ url('order/checkout') }}" class="btn">Checkout</a>
                                    <button class="btn" type="submit">Update Cart</button>
                                </div>
                            </div>
                        </div>
                        <!--Cart Summary End-->

                    </div>

                </div>
            
            @else
                <div>Không có sản phẩm nào trong giỏ hàng</div>
            @endIf
        </div>
    </div>
</form>
</div><!-- Cart Section End -->

@endsection