@extends('site.main')
@section('content')
        @include('site.elements.breadcumb', [$breadcumb, $title])
               <!--Single Product Section Start-->
               <div class="section section-padding pb-0">
                <div class="container">
    
                    <!--Single Product Wrapper Start-->
                    <div class="row mbn-20">
    
                        <!--Single Product Images Start-->
                        <div class="col-lg-6 col-12 mb-20">
                            <div class="single-product-images">
    
                                <!--Single Product Image Start-->
                                <div class="single-product-image">
                                    <img src="{{ asset('public/site') }}/images/products/single-product-1.jpg" alt="">
                                    <img src="{{ asset('public/site') }}/images/products/single-product-2.jpg" alt="">
                                    <img src="{{ asset('public/site') }}/images/products/single-product-3.jpg" alt="">
                                    <img src="{{ asset('public/site') }}/images/products/single-product-4.jpg" alt="">
                                    <img src="{{ asset('public/site') }}/images/products/single-product-5.jpg" alt="">
                                </div>
                                <!--Single Product Image End-->
    
                            </div>
                        </div>
                        <!--Single Product Image End-->
    
                        <!--Single Product Content Start-->
                        <div class="col-lg-6 col-12 mb-20">
                            <div class="single-product-content">
    
                                <!--Title & Price Start-->
                                <div class="title-price">
    
                                    <h2 class="title">{{ $item->name }}</h2>
    
                                    {!! createPrice($item->price, $item->sale_price) !!}
    
                                </div>
                                <!--Title & Price End-->
    
                                <!--Ratting Start-->
                                <div class="ratting">
                                    <div class="inner">
                                        <span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                    </div>
                                </div>
                                <!--Ratting End-->   
    
                                <!--Quantity Start-->
                                <div class="quantity">
                                    <h5>Quantity:</h5>
                                    <div class="pro-qty"><input type="text" value="1"></div>
                                </div>
                                <!--Quantity End-->
    
                                <!--Action Start-->
                                <div class="action">
                                    <a href="#" class="action-btn action-cart"><i class="icofont-shopping-cart"></i></a>
                                </div>
                                <!--Action End-->  
                            </div>
                        </div>
                        <!--Single Product Content End-->
    
    
                        <!--Single Product Description, Specifications & Reviews Start-->
                        <div class="col-12 mt-30 mb-20">
    
                            <ul class="single-product-tab-list nav">
                                <li><a href="#product-description" class="active" data-toggle="tab">description</a></li>
                                <li><a href="#product-reviews" data-toggle="tab" class="">reviews</a></li>
                            </ul>
    
                            <div class="single-product-tab-content tab-content">
                                <div class="tab-pane fade active show" id="product-description">
    
                                    <div class="row">
                                        <div class="single-product-description-content col-lg-8 col-12">
                                            {!! $item->description !!}
                                        </div>
                                    </div>
    
                                </div>                              
                                <div class="tab-pane fade" id="product-reviews">
    
                                    <!--Product Rating Form Wrapper Start-->
                                    <div class="product-ratting-wrap">      
                                        <!--Rating Wrapper Start-->
                                        <div class="rattings-wrapper">
    
                                            <!--Single Rating Start-->
                                            <div class="sin-rattings">
                                                <div class="ratting-author">
                                                    <h4>Cristopher Lee</h4>
                                                </div>
                                                <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli</p>
                                            </div>
                                            <!--Single Rating End-->
    
                                        </div>
                                        <!--Rating Wrapper End-->
    
                                        <!--Rating Form Wrapper Start-->
                                        <div class="ratting-form-wrapper">
                                            <h4>Add your Comments</h4>
                                            <form action="#">
                                                <div class="ratting-form row">
                                                    <div class="col-md-6 col-12 mb-20">
                                                        <label for="name">Name:</label>
                                                        <input id="name" placeholder="Name" type="text">
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-20">
                                                        <label for="email">Email:</label>
                                                        <input id="email" placeholder="Email" type="text">
                                                    </div>
                                                    <div class="col-12 mb-20">
                                                        <label for="your-review">Your Review:</label>
                                                        <textarea name="review" id="your-review" placeholder="Write a review"></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <input value="add review" type="submit" class="btn">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--Rating Form Wrapper End-->
    
                                    </div>
                                    <!--Product Rating Form Wrapper End-->
    
                                </div>
                            </div>
    
                        </div>
                        <!--Single Product Description, Specifications & Reviews End-->
    
                    </div>
                    <!--Single Product Wrapper End-->
    
                </div>
            </div>
            <!--Single Product Section End-->
    
@endsection