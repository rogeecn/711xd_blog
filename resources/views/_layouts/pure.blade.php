<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <meta name="keywords" content="@yield("keywords")">
    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
</head>
<body style="background: #f5f8f9;">

@include('_layouts._nav_component')

<div class="container">
    <div class="row">
        {{-- main content --}}
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>

@include("_layouts._footer")

<script src="{{ asset("js/jquery.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.js") }}"></script>
</body>
</html>