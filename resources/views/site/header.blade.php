
        <!-- Header Section Start -->
        <div class="header-section section section-wide header-sticky">
            <div class="container">
                <div class="row justify-content-between align-items-center">

                    <!-- Header Logo Start -->
                    <div class="col-auto">
                        <div class="header-logo">
                            <a href="{{ url('') }}"><img src="{{ asset('public/site') }}/images/logo/logo_1.png" alt="Logo"></a>
                        </div>
                    </div><!-- Header Logo End -->

                    <!-- Main Menu One Start -->
                     <div class="col-auto d-none d-lg-block position-static">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="menu-item-has-children"><a href="{{ url('') }}">Trang chủ</a></li>
                                    <li class="menu-item-has-children"><a href="{{ url('san-pham.html') }}">Sản phẩm</a>
                                        <ul class="sub-menu">
                                            @if(isset($list_category))
                                                @forEach($list_category as $item)
                                                    <li><a href="{{ url("san-pham/{$item->slug}.html") }}">{!! $item->name !!}</a></li>
                                                @endForeach
                                            @endIf    
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- Main Menu One End -->

                    <!-- User & Cart & Mobile Menu Button Start -->
                    <div class="col-auto d-flex flex-wrap align-items-center mr-5 mr-lg-0">
                        <div class="header-action">
                            <div class="header-user">
                                <a href="{{ url('login') }}" class="login"><i class="icofont-login"></i></a>
                                <a href="{{ url('customer') }}" class="user"><i class="icofont-user-alt-3"></i></a>
                            </div>
                            <div class="header-cart">
                                <a href="{{ url('order/cart') }}" class=""><span class="icon"><i class="icofont-cart"></i><span class="count"></span></span> <span class="text">{{ fotmatPrice(Cart::getTotal()) }}({{Cart::getContent()->count()}} items)</span></a>
                            </div>
                            <button class="mobile-menu-toggle"><i></i></button>
                        </div>
                    </div><!-- User & Cart & Mobile Menu Button End -->

                </div>
            </div>
        </div><!-- Header Section End -->

                {{-- @include('site.elements.cart') --}}
        
                <!--Offcanvas Mobile Menu Section Start-->
                <div class="offcanvas-mobile-menu">
                    <a href="javascript:void(0)" class="offcanvas-menu-close" id="mobile-menu-close-trigger"><i class="icofont-close-line"></i></a>
        
                    <div class="offcanvas-wrapper">
        
                        <div class="offcanvas-inner-content">
                            <div class="offcanvas-mobile-search-area">
                                <form action="#">
                                    <input type="search" placeholder="Search ...">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <nav class="offcanvas-navigation">
                                <ul>
                                    <li class="menu-item-has-children"><a href="index.html">Home</a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Home One</a></li>
                                            <li><a href="index-2.html">Home Two</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="shop.html">Shop</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item-has-children"><a href="shop.html">Shop Grid</a>
                                                <ul class="sub-menu">
                                                    <li><a href="shop.html">Left Sidebar</a></li>
                                                    <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                    <li><a href="shop-3-column.html">Three Column</a></li>
                                                    <li><a href="shop-4-column.html">Four Column</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="shop-list.html">Shop List</a>
                                                <ul class="sub-menu">
                                                    <li><a href="shop-list.html">Left Sidebar</a></li>
                                                    <li><a href="shop-list-right-sidebar.html">Right Sidebar</a></li>
                                                    <li><a href="shop-list-fullwidth.html">Fullwidth</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="single-product.html">Single Product</a>
                                                <ul class="sub-menu">
                                                    <li><a href="single-product.html">Standard</a></li>
                                                    <li><a href="single-product-variable.html">Variable</a></li>
                                                    <li><a href="single-product-affiliate.html">Affiliate</a></li>
                                                    <li><a href="single-product-group.html">Group</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="cart.html">Shopping Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="compare.html">Compare</a></li>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="login-register.html">Login & Register</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="blog-left-sidebar.html">Blog</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                            <li><a href="blog-3-column.html">Blog Three Column</a></li>
                                            <li><a href="single-blog-left-sidebar.html">Single Blog Left Sidebar</a></li>
                                            <li><a href="single-blog-right-sidebar.html">Single Blog Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
        
                            <div class="offcanvas-settings">
                                <nav class="offcanvas-navigation">
                                    <ul>
                                        <li class="menu-item-has-children"><a href="my-account.html">MY ACCOUNT </a>
                                            <ul class="sub-menu">
                                                <li><a href="login-register.html">Register</a></li>
                                                <li><a href="login-register.html">Login</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">CURRENCY: USD </a>
                                            <ul class="sub-menu">
                                                <li><a href="javascript:void(0)">€ Euro</a></li>
                                                <li><a href="javascript:void(0)">$ US Dollar</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">LANGUAGE: EN-GB </a>
                                            <ul class="sub-menu">
                                                <li><a href="javascript:void(0)">English</a></li>
                                                <li><a href="javascript:void(0)">Germany</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
        
                            <div class="offcanvas-widget-area">
                                <div class="offcanvas-contact-widget">
                                    <ul class="header-contact-info">
                                        <li><i class="fa fa-phone"></i> <a href="tel://12452456012">(1245) 2456 012 </a></li>
                                        <li><i class="fa fa-envelope"></i> <a href="mailto:info@yourdomain.com">info@yourdomain.com</a></li>
                                    </ul>
                                </div>
                                <!--Off Canvas Widget Social Start-->
                                <div class="offcanvas-widget-social">
                                    <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    <a href="#" title="Youtube"><i class="fa fa-youtube-play"></i></a>
                                    <a href="#" title="Vimeo"><i class="fa fa-vimeo-square"></i></a>
                                </div>
                                <!--Off Canvas Widget Social End-->
                            </div>
                        </div>
                    </div>
        
                </div>
                <!--Offcanvas Mobile Menu Section End-->