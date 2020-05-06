@extends('site.main')
@section('content')
@include('site.elements.breadcumb', [$breadcumb, $title])
 <!-- Login & Register Section Start -->
 <div class="section section-padding">
    <div class="container">
        <div class="row mbn-40">
            <!-- Login Form Start -->
            <div class="col-lg-4 col-md-6 col-12 mr-auto mb-40">
                <div class="login-register-form">
                    <h3 class="mb-15">Đăng kí</h3>
                    <form action="{{ url('register') }}" method="POST">
                        @if(session('message'))
                            <li>{{ session('message') }}</li>
                        @endif
                        <input name="_token" value="{{ csrf_token() }}" type="hidden" />
                        <div class="row">
                            <div class="col-12 mb-20">
                                <input name="name" placeholder="Tên" value="{{ old('name') }}" type="text">
                                @error('name')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-20">
                                <input name="username" value="{{ old('username') }}" placeholder="Tên đăng nhập" type="text">
                                @error('username')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input name="password" placeholder="Mật khẩu" type="password">
                                @error('password')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-round btn-lg">Tạo tài khoản</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login Form End -->
        </div>
    </div>
</div><!-- Login & Register Section End -->
@endsection