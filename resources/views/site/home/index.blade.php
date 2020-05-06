@extends('site.main')

@section('content')
<?php
    $prefix     = 'product';
    $name_item  = 'sản phẩm';
    $link_image = url("uploads/admin/{$prefix}");
?>
 <!--Hero Slider Section Start-->
        {{-- <div class="section section-wide">
            <div class="container-fluid">

                <!--hero Slider Start-->
                <div class="hero-slider">

                    <div class="hero-item hero-bg-1">
                        <div class="hero-content">
                            <h2 class="title">Capture your <br>Beautiful moments</h2>
                                <a href="#" class="btn">Buy Now</a>
                        </div>
                    </div>

                    <div class="hero-item hero-bg-2">
                        <div class="hero-content">
                            <h2 class="title">Capture your <br>dkm</h2>
                                <a href="#" class="btn">Buy Now</a>
                        </div>
                    </div>

                    
                    <div class="hero-item hero-bg-2">
                        <div class="hero-content">
                            <h2 class="title">Capture your <br>Beautiful moments</h2>
                                <a href="#" class="btn">Buy Now</a>
                        </div>
                    </div>

                </div>
                <!--hero Slider End-->

            </div>
        </div> --}}
        <!--Hero Slider Section End-->
         <!--Banner Section Start-->
         <div class="section section-wide section-padding">
            <div class="container-fluid">
                <div class="row mbn-30">

                    <!--Banner Start-->

                    <!--Banner End-->
                    <?php
                    $xhtmlBanner = '';
                    if($banners) {
                        foreach ($banners as $key => $item) {
                            $image = url("uploads/admin/banner/{$item->image}");
                            $xhtmlBanner .= '<div class="col-sm-3 col-6 mb-30">
                                                <div class="banner">
                                                    <a href="'.$item->link.'"><img src="'.$image.'" alt="Banner"></a>
                                                </div>
                                            </div>';
                        }
                    }
                    echo $xhtmlBanner;
                    ?>
                </div>
            </div>
        </div>
        <!--Banner Section End-->
 <!--Propular Products Section Start-->
 <div class="section section-wide section-padding pt-0">
    <div class="container-fluid">
        <div class="row mbn-40">

            <!--Section Title Start-->
            {{-- <div class="col-12">
                <div class="row">
                    <div class="col-lg-9 col-12 ml-auto">
                        <div class="section-title">
                            <h2 class="title">Popular in this week</h2>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--Section Title End-->

            <!--Product Wrapper Start-->
            <div class="col-lg-9 col-12 order-lg-3 mb-40">
                <div class="row mbn-35">
                    <!--Product Start-->
                    <?php
                    $xhtmlListItem = '';
                    if($items) {
                        foreach ($items as $key => $item) {
                            $image = url("uploads/admin/product/{$item->image}");
                            $url_cart = url("order/cart/add/{$item->id}");;
                            $url_detail = url("chi-tiet-san-pham/{$item->slug}.html");

                            $xhtmlListItem .= '<div class="col-xl-3 col-md-4 col-6 col-xxs-12 mb-35">
                                                <div class="product">

                                                    <!--Image & Action Start-->
                                                    <div class="image-action">

                                                        <a class="image" href="'.$url_detail.'"><img src="'.$image.'" alt=""></a>

                                                        '.createBtnNewSale($item->created_at, $item->sale_price).'

                                                        <a href="'.$url_cart.'" class="wishlist-btn"><i class="icofont-heart"></i></a>

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
                                                                <span style="width: 80%;">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </span>
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

            <!--Banner Wrapper Start-->
            <div class="col-lg-3 col-12 order-lg-2 mb-40">
                <div class="row mbn-35">

                    <!--Banner Start-->
                    <div class="col-lg-12 col-6 mb-35">
                        <div class="banner">
                            <a href="#"><img src="{{ asset('public/site') }}/images/banner/banner-4.jpg" alt="Banner"></a>
                        </div>
                    </div>
                    <!--Banner End-->

                    <!--Banner Start-->
                    <div class="col-lg-12 col-6 mb-35">
                        <div class="banner">
                            <a href="#"><img src="{{ asset('public/site') }}/images/banner/banner-5.jpg" alt="Banner"></a>
                        </div>
                    </div>
                    <!--Banner End-->

                </div>
            </div>
            <!--Banner Wrapper End-->

        </div>
    </div>
</div>
<!--Propular Products Section End-->
@endsection