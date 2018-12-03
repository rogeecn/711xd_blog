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
        .article-title {
            color: #343a40;
            text-decoration: none;
        }

        .article-title:hover {
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
                <form class="card-body" action="{{ route("search") }}">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text"
                                   name="keyword"
                                   class="form-control"
                                   placeholder="请输入关键字"
                                   value="{{ $keyword??"" }}"
                            >
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">搜索</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>
</div>

@include("_layouts._footer")

<script src="{{ asset("js/jquery.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.js") }}"></script>
</body>
</html>