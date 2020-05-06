<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bất động sản</title>
    <!-- link css -->
    @include('admin.link')
</head>
<body>
    <!-- header -->
    @include('admin.header')
    <!-- end header -->
<section class="main" role="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 padd-0">
                <!-- sidebar -->
                @include('admin.sidebar')
                <!-- end sidebar -->
            </div>
            <div class="col-md-10 padd-left-0">
                <!-- content-->
                <div class="main-content">                  
                    @yield('content')
                </div>
                <!-- end div.main-content -->
            </div>
        </div>
    </div>
</section>
<!-- link script -->
@include('admin.script')
</body>
</html>