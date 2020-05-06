@extends('site.main')

@section('content')
<!-- Cart Section Start -->
<div class="section section-padding">
    <div class="container">
        <div class="row">
            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        </div>
    </div>
</div><!-- Cart Section End -->

@endsection