@extends('site.main')

@section('content')
        @include('site.elements.breadcumb', [$breadcumb, $title])
        <!--Product Section Start-->
        <div class="section section-padding">
            <div class="container">
                <div class="row mbn-40">

                    <!--Product Wrapper Start-->
                    <div class="col-lg-9 col-12 order-lg-2 mb-40">

                        <!--Shop Toolbar Start-->
                        <div class="shop-toolbar">

                            <!--Product View Mode Start-->
                            <div class="product-view-mode">
                                <button class="active" data-mode="grid"><i class="fa fa-th"></i></button>
                                <button data-mode="list"><i class="fa fa-align-justify"></i></button>
                            </div>
                            <!--Product View Mode End-->

                            <!--Product Showing Start-->
                            <div class="product-showing mr-auto">
                                <p>Showing 9 of 72</p>
                            </div>
                            <!--Product Showing End-->
                        </div>
                        <!--Shop Toolbar End-->

                        <div class="shop-product-wrap row mbn-35">

                            <!--Product Start-->
                            <?php
                                $xhtmlListItem = '';
                                if($items) {
                                    foreach ($items as $key => $item) {
                                        $image = url("uploads/admin/product/{$item->image}");
                                        $url_cart = url("order/cart/add/{$item->id}");;
                                        $url_detail = url("chi-tiet-san-pham/{$item->slug}.html");
                                        $xhtmlListItem .= '<div class="col-md-4 col-6 col-xxs-12 mb-35">
                                                                <div class="product">
                                                                    <!--Image & Action Start-->
                                                                    <div class="image-action">
                                                                        <a class="image" href="'.$url_detail.'"><img src="'.$image.'" alt=""></a>
                                                                        '.createBtnNewSale($item->created_at, $item->sale_price).'
                                                                        <!--Action Start-->
                                                                        <div class="action">
                                                                            <a href="'.$url_cart.'" class="action-btn action-cart"><i class="icofont-shopping-cart"></i></a>
                                                                        </div>
                                                                        <!--Action End-->
                                                                    </div>
                                                                    <!--Image & Action End-->
                                                                    <!--Content Start-->
                                                                    <div class="content">
                                                                        <!--Title & Price Start-->
                                                                        <div class="title-price">
                                                                            <h4 class="title"><a href="'.$url_detail.'">'.$item->name.'</a></h4>
                                                                            '.createPrice($item->price, $item->sale_price).'
                                                                        </div>
                                                                        <!--Title & Price End-->
                                                                        <!--Ratting Start-->
                                                                        <div class="ratting">
                                                                            <div class="inner">
                                                                                <span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <!--Ratting End-->
                                                                    </div>
                                                                    <!--Content End-->
                                                                </div>
                                                            </div>';
                                    }
                                }
                                echo $xhtmlListItem;
                            ?>
                            <!--Product End-->

                        </div>

                    </div>
                    <!--Product Wrapper End-->
                    @include('site.elements.sidebar_product', $list_category)
                </div>
            </div>
        </div>
        <!--Product Section End-->
@endsection