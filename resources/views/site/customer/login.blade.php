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
                    <h3 class="mb-15">Already a Member?</h3>
                    <form action="{{ url('login') }}" method="POST">
                        @if(session('message'))
                            <li>{{ session('message') }}</li>
                        @endif
                        <input name="_token" value="{{ csrf_token() }}" type="hidden" />
                        <div class="row">
                            <div class="col-12 mb-20">
                                <input name="username" placeholder="Username" type="text">
                                @error('username')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input name="password" placeholder="Password" type="password">
                                @error('password')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-round btn-lg">Login</button>
                                <a href="{{ url('register') }}" class="btn btn-round btn-lg">Đăng kí</a>
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