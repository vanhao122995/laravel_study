<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Garcia - Camera Store HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('site.link')
</head>
<body>
    <div class="main-wrapper">
        @include('site.header')
        
        @yield('content')

        {{-- @include('site.elements.subcrible') --}}
        @include('site.elements.service')
        @include('site.footer')
    </div>
    @include('site.script')
</body>
</html>