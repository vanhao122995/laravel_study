                    <!--Sidebar Wrapper Start-->
                    <div class="col-lg-3 col-12 order-lg-1 mb-40">
                        <div class="row mbn-35">

                            <!--Sidebar Start-->
                            <div class="col-12 mb-35">
                                <div class="widget">
                                    <h4 class="widget-title">Search</h4>
                                    <div class="widget-search">
                                        <form action="#">
                                            <input type="search" placeholder="Search">
                                            <button><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Sidebar End-->

                            <!--Sidebar Start-->
                            <div class="col-12 mb-35">
                                <div class="widget">
                                    <h4 class="widget-title">Danh mục sản phẩm</h4>
                                    <ul class="widget-link">
                                        @if($list_category)
                                            @forEach($list_category as $item)
                                                <li><a href="{{ url("san-pham/{$item->slug}.html") }}">{{ $item->name }}</a></li>
                                            @endForeach
                                        @endIf                               
                                    </ul>
                                </div>
                            </div>
                            <!--Sidebar End-->
                        </div>
                    </div>
                    <!--Sidebar Wrapper End-->