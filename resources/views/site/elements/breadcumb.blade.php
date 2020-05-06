
        <!--Page Banner Section Start-->
        <div class="section section-wide">
            <div class="container-fluid">

                <!--Page Banner Start-->
                <div class="page-banner">
                    <div class="container">
                        <h2 class="page-title">{{ $title }}</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="{{ url('') }}">Trang chủ</a></li>
                            @if($breadcumb)
                                @forEach($breadcumb as $key => $row)
                                    @if(count($breadcumb) - 1 == $key)
                                        <li>{{ $row['name'] }}</li>                
                                    @else
                                        <li><a href="{{ $row['link'] }}">{{ $row['name'] }}</a></li>
                                    @endIf
                                @endForeach
                            @endIf   
                        </ul>                        
                    </div>
                </div>
                <!--Page Banner End-->

            </div>
        </div>
        <!--Page Banner Section End-->