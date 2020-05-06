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
<section class="main" role="main">
    <div class="container-fluid">
        <div class="row">
                <!-- content-->
                <div class="main-content">                  
                    <div class="login-container col-md-4 col-md-offset-4" id="login-form">
                        <div class="login-frame clearfix">
                            <h3 class="heading col-md-10 col-md-offset-1 padd-0"><i class="fa fa-lock"></i>Đăng nhập</h3>
                            <ul class="validation-summary-errors col-md-10 col-md-offset-1">
                                @if(session('message'))
                                    <li>{{ session('message') }}</li>
                                @endif
                            </ul>
                            <div class="col-md-10 col-md-offset-1">
                                <form class="form-horizontal login-form frm-sm" method="post" action="{{ url("admin/post-login") }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group input-icon">
                                        <label for="inputEmail3" class="sr-only control-label">Username</label>
                                        <input type="text" name="username" value="" class="form-control" id="inputEmail3" placeholder="Tên đăng nhập">
                                        <i class="fa fa-user icon-right"></i>
                                        @error('username')
                                        <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group input-icon">
                                        <label for="inputPassword3" class="sr-only control-label">Password</label>
                                        <input type="password" name="password" value="" class="form-control" id="inputPassword3" placeholder="Mật khẩu">
                                        <i class="fa fa-lock icon-right"></i>
                                        @error('password')
                                        <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="login" value="Đăng nhập" class="btn btn-primary btn-sm"/>
                                       <!-- <button class="btn btn-primary btn-sm btn-smf"><i class="fa fa-key"></i>Đăng nhập</button>
                                        <div class="action-none" style="display: none;">
                                            <input type="submit" name="login" value="Dang nhap" class="btn-sm-after"/>
                                        </div> -->
                    
                                    </div>
                                </form>
                            </div>
                        </div>                   
                    </div>
                </div>
                <!-- end div.main-content -->
        </div>
    </div>
</section>
<!-- link script -->
@include('admin.script')
</body>
</html>