<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{--<!-- Scripts -->--}}
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    {{--<!-- Styles -->--}}
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    {{--bootstrap--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    @yield('head')

</head>
<body>
<div id="app">
    {{--<nav class="navbar navbar-dark fixed-top bg-light flex-md-nowrap p-0 shadow">--}}
        {{--<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>--}}

        {{--<ul class="navbar-nav px-3">--}}
            {{--<li class="nav-item text-nowrap">--}}
                {{--<a class="nav-link" href="#">Sign out</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</nav>--}}

    <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top border-bottom" style="z-index: 999">
        <a class="navbar-brand ml-1" href="{{ url('/') }}">
            {{--{{ config('app.name', 'Laravel') }}--}}
            <img src="assets/img/LOGO_text.png" style="height:35px;">
        </a>
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="index">主页</a>
                    </li>

                    <li class="nav-item dropdown mr-3">
                        <a id="blogMenu" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                             发现想法
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="categories-1">
                                文娱点评
                            </a>
                            <a class="dropdown-item" href="categories-2">
                                军事分析
                            </a>
                            <a class="dropdown-item" href="categories-3">
                                时事评论
                            </a>
                            <a class="dropdown-item" href="categories-4">
                                技术博客
                            </a>
                            <a class="dropdown-item" href="categories-5">
                                教育文化
                            </a>
                            <a class="dropdown-item" href="categories-6">
                                全部分类
                            </a>
                        </div>
                    </li>

                    <li id='editMenu' class="nav-item mr-3">
                        <a class="nav-link" href="edit">发表看法</a>
                    </li>

                    <li class="nav-item mr-3">
                        <a class="nav-link" href="contact">消息</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="accountMenu" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/account">账户设置</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</div>

@yield('script')

</body>
</html>
