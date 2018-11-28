<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom mb-5 shadow">

    {{--brand--}}
    <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
    <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#nav-bar"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="nav-bar">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">首页</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">标签</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">友情链接</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">关于我</a>
            </li>

        </ul>

        {{-- right nav bar --}}
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">友情链接</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">关于我</a>
            </li>

        </ul>
    </div>
</nav>
