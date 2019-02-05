<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap-theme.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <!-- Flexslider -->
    <link rel="stylesheet" href="assets/css/flexslider.css">
    <!-- Owl -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    @yield('head')


</head>
<body>

@yield('sidenav')

<!--  Main Wrap  -->
<div id="main-wrap">
    <!--  Header & Menu  -->
    <header id="header" class="border">
        <div class="container">
            <nav class="navbar navbar-default">
                <!--  Header Logo  -->
                <div id="logo">
                    <a class="navbar-brand" href="index">
                        <img src="assets/img/LOGO.png" class="normal" alt="logo">
                        <img src="assets/img/LOGO_text.png" class="retina" alt="logo">
                    </a>
                </div>
                <!--  END Header Logo  -->
                <!--  Menu  -->
                <div id="sidemenu">
                    <div class="menu-holder">
                        <ul>
                            <li>
                                <a id="index" href="index">主页</a>
                            </li>
                            <li>
                            <li class="submenu">
                                <a id="categories" href="#">发现想法</a>
                                <ul class="sub-menu">
                                    <li><a href="categories-1?page=1">文娱点评</a></li>
                                    <li><a href="categories-2?page=1">军事分析</a></li>
                                    <li><a href="categories-3?page=1">时事评论</a></li>
                                    <li><a href="categories-4?page=1">技术博客</a></li>
                                    <li><a href="categories-5?page=1">教育文化</a></li>
                                    <li><a href="categories-6?page=1">全部分类</a></li>
                                </ul>
                            </li>
                            <li>
                                <a id="editor" href="edit">发表看法</a>
                            </li>
                            <li>
                                <a href="contacts.html">消息</a>
                            </li>
                            <!-- Authentication Links -->
                            @guest
                                <li>
                                    <a class="nav-link" href="{{ route('login') }}">登录</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a class="nav-link" href="{{ route('register') }}">注册</a>
                                    </li>
                                @endif
                            @else
                                <li class="submenu">
                                    <a href="#">{{ Auth::user()->name }}</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="/account">账户设置</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                退出登录
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            @endguest

                        </ul>
                    </div>
                </div>
                <!--  END Menu  -->
                <!--  Button for Responsive Menu  -->
                <div id="menu-responsive-sidemenu">
                    <div class="menu-button">
                        <span class="bar bar-1"></span>
                        <span class="bar bar-2"></span>
                        <span class="bar bar-3"></span>
                    </div>
                </div>
                <!--  END Button for Responsive Menu  -->

            </nav>
        </div>
    </header>
    <!--  END Header & Menu  -->
    @yield('content')
</div>
<!--  Footer  -->
<footer>
    <div class="container">
        <div class="row no-margin">
            <div class="col-md-3 text">
                <h5>DLArtist</h5>
                <p>© 2017 Made with love by <a href="http://wearepuredesign.com/"
                                               target="_blank">puredesignThemes</a></p>
            </div>
            <div class="col-md-3 text small">
                <p>322 Moon St, Venice, 1231, Italy<br>
                    Mon. - Fri., 9 a.m. - 6.00 p.m.</p>
            </div>
            <div class="col-md-2 text small">
                <p>+(39) 245 45 78 54<br>
                    hey@whiteble.com</p>
            </div>
            <div class="col-md-4 text">
                <div class="row no-margin">
                    <ul class="social">
                        <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-behance" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--  END Footer. Class fixed for fixed footer  -->
<!-- icons-->
<script src="https://unpkg.com/ionicons@4.5.1/dist/ionicons.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery.min.js"></script>
<!-- All js library -->
<script src="assets/js/bootstrap/bootstrap.min.js"></script>
<script src="assets/js/jquery.flexslider-min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
{{--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false"></script>--}}
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/smooth.scroll.min.js"></script>
<script src="assets/js/jquery.appear.js"></script>
<script src="assets/js/jquery.countTo.js"></script>
<script src="assets/js/jquery.scrolly.js"></script>
<script src="assets/js/plugins-scroll.js"></script>
<script src="assets/js/imagesloaded.min.js"></script>
<script src="assets/js/pace.min.js"></script>
<script src="assets/js/main.js"></script>


@yield('script')


</body>

</html>