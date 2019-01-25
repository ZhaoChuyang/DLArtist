@extends('layouts.shop')
@section('content')
    <script>
        $(function () {
            $("#categories").addClass("active-item");
        });
    </script>
    <!--  Page Content  -->
    <div id="page-content">
        <!--  Page header  -->
        <div class="container">
            <div class="row no-margin">
                <div class="col-md-12 padding-leftright-null">
                    <div id="page-header">
                        <div class="text">
                            <h1 class="margin-bottom-small">Categories<span class="color">.</span></h1>
                            <p class="heading left max full grey-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae quos rem, error facilis eveniet perspiciatis tempora totam animi doloribus. Quia officia laudantium dolor sapiente? Dolor maxime voluptatum sint molestias ipsa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END Page header  -->
        <div id="home-wrap" class="content-section">
            <!-- Blog -->
            <div class="container">
                <div class="row no-margin wrap-text">
                    <!--  News Section  -->
                    <section id="news" class="page">
                        <div class="news-items equal three-columns">
                            <!-- Single News -->
                            <div class="single-news one-item">
                                <article>
                                    <img src="assets/img/news1.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">Entertainment News</span>
                                        <h3>文娱点评</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <a href="categories-1" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <!-- END Single News -->
                            <div class="single-news one-item">
                                <article>
                                    <img src="assets/img/news2.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">Military analysis</span>
                                        <h3>军事分析</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <a href="categories-2" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div class="single-news one-item">
                                <article>
                                    <img src="assets/img/news3.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">Comments on current events</span>
                                        <h3>时事评论</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <a href="categories-3" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div class="single-news one-item">
                                <article>
                                    <img src="assets/img/news4.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">Engineering blog</span>
                                        <h3>技术博客</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <a href="categories-4" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div class="single-news one-item">
                                <article>
                                    <img src="assets/img/news5.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">Education and Culture</span>
                                        <h3>教育文化</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <a href="categories-5" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div class="single-news one-item">
                                <article>
                                    <img src="assets/img/news5.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">All News</span>
                                        <h3>全部分类</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <a href="categories-6" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </section>
                    <!-- END News -->
                </div>
            </div>
            <!-- Full width Border Separator -->
            <div class="row no-margin">
                <div class="border-separator"></div>
            </div>
            <!-- END Full Width Border Separator -->
            <div class="container">
                <!--  Navigation  -->
                <section id="nav" class="padding-onlytop-lg">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="nav-left">
                                <a href="index" class="btn-alt small shadow margin-null"><i class="icon ion-ios-arrow-left"></i><span>返回主页</span></a>
                            </div>
                        </div>
                        {{--<div class="col-xs-6">--}}
                            {{--<div class="nav-right">--}}
                                {{--<a href="#" class="btn-alt small shadow margin-null"><span>Newer posts</span><i class="icon ion-ios-arrow-right"></i></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </section>
                <!--  END Navigation  -->
            </div>
        </div>
        <!-- END Blog -->
    </div>
    <!--  END Page Content -->
    </div>
    <!--  Main Wrap  -->
@endsection