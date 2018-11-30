<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("css/markdown.css") }}">

    <style>
        .article-title{
            color: #343a40;
            text-decoration: none;
        }

        .article-title:hover{
            text-decoration: none;
        }
    </style>
</head>
<body style="background: #f5f8f9;">
@include('_layouts._nav_component')

<div class="container">
    <div class="row">
        {{-- main content --}}
        <div class="col-md-8">
            @yield('content')
        </div>

        {{--side bard--}}
        <div class="col-md-4">

            <div class="card bg-white border-0 ">
                <div class="card-body">
                    <h3 class="card-title">Hello</h3>
                    hello world
                </div>
            </div>


        </div>

    </div>
</div>

@include("_layouts._footer")

<script src="{{ asset("js/jquery.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.js") }}"></script>
</body>
</html>