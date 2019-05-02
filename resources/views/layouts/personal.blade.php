<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>DLArtist-首页</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="/css/linearicons.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    {{--<link rel="stylesheet" href="/css/jquery-ui.css">--}}
    <link rel="stylesheet" href="/css/nice-select.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/main.css">

    @yield('head')

</head>
<body>
<header id="header">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="index.html"><img src="/assets/img/LOGO_text.png" width="130" height="33" alt="" title="" /></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="/index1">Home</a></li>
                    <li><a href="/categories">Articles</a></li>
                    <li><a href="/test">Editor</a></li>
                    <li><a href="price.html">Notification</a></li>
                    <!-- Authentication Links -->
                    @guest
                        <li>
                            <a class="nav-link" href="{{ route('login') }}">login</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a class="nav-link" href="{{ route('register') }}">register</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="/account">{{ Auth::user()->name }}</a>
                        </li>
                    @endguest
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header><!-- #header -->

@yield('content')

@yield('script')

</body>
</html>