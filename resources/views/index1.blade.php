<?php
use DLArtist\User;
?>
@extends('layouts.personal')

@section('head')

@endsection

@section('content')
    <!-- start banner Area -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6 banner-left">
                    <h6>This is our site</h6>
                    <h1>DLArtist</h1>
                    <p>
                        这是一个基于人工智能以及web技术，为用户提供文字编辑，智能排版，插图处理，文章发布，社区浏览，相似推荐等系列功能的综合性创意设计网站。
                    </p>
                    <a href="/categories" class="primary-btn text-uppercase">discover now</a>
                </div>
                <div class="col-lg-6 col-md-6 banner-right d-flex align-self-end">
                    <img class="img-fluid" src="images/book.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start home-about Area -->
    <section class="home-about-area pt-120">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6 home-about-left">
                    <img class="img-fluid" src="images/about-img.png" alt="">
                </div>
                <div class="col-lg-5 col-md-6 home-about-right">
                    <h6>About DLArtist</h6>
                    <h1 class="text-uppercase">Website Details</h1>
                    <p>
                        DLArtist是一个结合人工智能技术和Web技术同时在文字排版和图像处理方面提供一种新的用户体验和使用场景的文章创作与阅读平台。DLArtist提供的具体功能有，智能排版，图像处理，社区功能。
                    </p>
                    <a href="#" class="primary-btn text-uppercase">View Full Details</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End home-about Area -->

    <!-- Start services Area -->
    <section class="services-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content  col-lg-7">
                    <div class="title text-center">
                        <h1 class="mb-10">My Offered Services</h1>
                        <p>At about this time of year, some months after New Year’s resolutions have been made and kept, or made and neglected.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-services">
                        <span class="lnr lnr-magic-wand"></span>
                        <a href="#"><h4>自动排版</h4></a>
                        <p>
                            “It is not because things are difficult that we do not dare; it is because we do not dare that they are difficult.”
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-services">
                        <span class="lnr lnr-picture"></span>
                        <a href="#"><h4>插图处理</h4></a>
                        <p>
                            If you are an entrepreneur, you know that your success cannot depend on the opinions of others. Like the wind, opinions.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-services">
                        <span class="lnr lnr-layers"></span>
                        <a href="#"><h4>智能图库</h4></a>
                        <p>
                            Do you want to be even more successful? Learn to love learning and growth. The more effort you put into improving your skills.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-services">
                        <span class="lnr lnr-pencil"></span>
                        <a href="#"><h4>文章发布</h4></a>
                        <p>
                            Hypnosis quit smoking methods maintain caused quite a stir in the medical world over the last two decades. There is a lot of argument.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-services">
                        <span class="lnr lnr-cloud"></span>
                        <a href="#"><h4>社区动态</h4></a>
                        <p>
                            Do you sometimes have the feeling that you’re running into the same obstacles over and over again? Many of my conflicts.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-services">
                        <span class="lnr lnr-star-half"></span>
                        <a href="#"><h4>相似推荐</h4></a>
                        <p>
                            You’ve heard the expression, “Just believe it and it will come.” Well, technically, that is true, however, ‘believing’ is not just thinking that.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End services Area -->

    <!-- Start fact Area -->
    <section class="facts-area section-gap" id="facts-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 single-fact">
                    <h1 class="counter">20</h1>
                    <p>Document models</p>
                </div>
                <div class="col-lg-3 col-md-6 single-fact">
                    <h1 class="counter">10</h1>
                    <p>Happy Clients</p>
                </div>
                <div class="col-lg-3 col-md-6 single-fact">
                    <h1 class="counter">100</h1>
                    <p>Watch num</p>
                </div>
                <div class="col-lg-3 col-md-6 single-fact">
                    <h1 class="counter">4</h1>
                    <p>Developers</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end fact Area -->

    <!-- Start portfolio-area Area -->
    <section class="portfolio-area section-gap" id="portfolio">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">最热门文章</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>

            <div class="filters">
                <ul>
                    <li class="active" data-filter="*">All</li>
                    <li data-filter=".1">新闻</li>
                    <li data-filter=".2">体育</li>
                    <li data-filter=".3">财经</li>
                    <li data-filter=".4">娱乐</li>
                    <li data-filter=".5">时尚</li>
                    <li data-filter=".6">科技</li>
                </ul>
            </div>

            <div class="filters-content">
                <div class="row grid">
                    <!--记得加代码,每次推荐六个-->
                    @foreach($articlesForAll as $article)
                        <div class="single-portfolio col-sm-4 all {{$article->category}}">
                            <div class="relative">
                                <div class="thumb">
                                    <div class="overlay overlay-bg"></div>
                                    <img class="image img-fluid" src={{$article->cover_url}} alt="">
                                </div>
                                <a href="/article/{{$article->id}}">
                                    <div class="middle">
                                        <div class="text align-self-center d-flex"><img src="/images/preview.png" alt=""></div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-inner">
                                <h4>{{$article->title}}</h4>
                                <div class="cat">{{$article->author}}</div>
                            </div>
                        </div>

                    @endforeach


                </div>
            </div>

        </div>
    </section>
    <!-- End portfolio-area Area -->

    <!-- Start testimonial Area -->

    <!-- Start price Area -->

    <!-- Start recent-blog Area -->
    <section class="recent-blog-area section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 pb-30 header-text">
                    <h1>为您推荐</h1>
                    <p>
                        According to your browser history, we recommend these articles for you.
                    </p>
                </div>
            </div>
            <div class="row">
                <!--修改代码, 根据推荐系统推荐-->

                @foreach($articlesForYou as $article)
                    <div class="single-recent-blog col-lg-4 col-md-4">

                        <div class="thumb">
                            <img class="f-img img-fluid mx-auto" src={{$article->cover_url}} alt="">
                        </div>
                        <div class="bottom d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <img class="img-fluid" src="storage{{User::find($article->user_id)->avatar_url}}" width="32.269" height="32.269"alt="">
                                <a href="#"><span>{{User::find($article->user_id)->name}}</span></a>
                            </div>
                            <div class="meta">
                                {{$article->update}}
                                <span class="lnr lnr-heart"></span> {{$article->click_num}}
                                <span class="lnr lnr-bubble"></span> 04
                            </div>
                        </div>
                        <a href="/article/{{$article->id}}">
                            <h4>{{$article->title}}</h4>
                        </a>
                        <p>
                            {{$article->summary}}
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- end recent-blog Area -->

    <!-- Start brands Area -->
    {{--<section class="brands-area">--}}
    {{--<div class="container">--}}
    {{--<div class="brand-wrap">--}}
    {{--<div class="row align-items-center active-brand-carusel justify-content-start no-gutters">--}}
    {{--<div class="col single-brand">--}}
    {{--<a href="#"><img class="mx-auto" src="img/l1.png" alt=""></a>--}}
    {{--</div>--}}
    {{--<div class="col single-brand">--}}
    {{--<a href="#"><img class="mx-auto" src="img/l2.png" alt=""></a>--}}
    {{--</div>--}}
    {{--<div class="col single-brand">--}}
    {{--<a href="#"><img class="mx-auto" src="img/l3.png" alt=""></a>--}}
    {{--</div>--}}
    {{--<div class="col single-brand">--}}
    {{--<a href="#"><img class="mx-auto" src="img/l4.png" alt=""></a>--}}
    {{--</div>--}}
    {{--<div class="col single-brand">--}}
    {{--<a href="#"><img class="mx-auto" src="img/l5.png" alt=""></a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    <!-- End brands Area -->

    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4>About Me</h4>
                        <p>
                            We have tested a number of registry fix and clean utilities and present our top 3 list on our site for your convenience.
                        </p>
                        <p class="footer-text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4>Newsletter</h4>
                        <p>Stay updated with our latest trends</p>
                        <div class="" id="mc_embed_signup">
                            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="EMAIL" placeholder="Enter Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address '" required="" type="email">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <span class="lnr lnr-arrow-right"></span>
                                        </button>
                                    </div>
                                    <div class="info"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                    <div class="single-footer-widget">
                        <h4>Follow Me</h4>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/easing.min.js"></script>
    <script src="js/hoverIntent.js"></script>
    <script src="js/superfish.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.tabs.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/simple-skillbar.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/main.js"></script>
@endsection