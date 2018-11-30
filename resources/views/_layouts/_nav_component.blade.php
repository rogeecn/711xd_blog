<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom mb-5

    {{--brand--}}
        <a class=" navbar-brand" href="/">{{ config('app.name') }}</a>
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
            <a class="nav-link" href="{{ route('index') }}">首页</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tag.list') }}">标签</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('friendlink') }}">友情链接</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">关于我</a>
        </li>

    </ul>

    {{-- right nav bar --}}
    <ul class="navbar-nav">

        @guest()
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">登录</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('post.create') }}">写文章</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    退出登录
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest()

    </ul>
</div>
</nav>
