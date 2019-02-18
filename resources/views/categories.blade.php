@extends('layouts.shop')

@section('head')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

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


                <section id="projects" data-isotope="load-simple" class="page padding-top-null padding-onlybottom-lg">
                    <!--  Filters  -->
                    <div class="row no-margin text-left">
                        <div class="col-sm-12 padding-leftright-null">
                            <div class="filter-wrap left">
                                <ul class="col-md-12 filters uppercase padding-leftright-null" id="filter">
                                    <li value='0' class="is-checked">所有文章</li>
                                    <li value='1' class="">文娱点评</li>
                                    <li value='2' class="">军事分析</li>
                                    <li value='3' class="">时事评论</li>
                                    <li value='4' class="">技术博客</li>
                                    <li value='5' class="">教育文化</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--  END Filters  -->

                    <div class="row no-margin text-left">
                        <div class="col-sm-12 padding-leftright-null">
                            <div class="filter-wrap left">
                                <ul class="col-md-12 filters uppercase padding-leftright-null" id="sorter">
                                    <li class="is-checked" value="1">名称<i class="fa fa-fw fa-sort"></i></li>
                                    <li class="" value="2">日期<i class="fa fa-fw fa-sort"></i></li>
                                    <li class="" value="3">热度<i class="fa fa-fw fa-sort"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <section id="news" class="page" style="padding-top:0;">
                        <div class="news-items equal three-columns">
                            <!-- Single News -->
                            <div class="single-news one-item">
                                <article>
                                    <img src="assets/img/news1.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">Entertainment News</span>
                                        <h3>文娱点评</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <a href="categories-1?page=1" class="btn-pro">Read more</a>
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
                                        <a href="categories-2?page=1" class="btn-pro">Read more</a>
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
                                        <a href="categories-3?page=1" class="btn-pro">Read more</a>
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
                                        <a href="categories-4?page=1" class="btn-pro">Read more</a>
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
                                        <a href="categories-5?page=1" class="btn-pro">Read more</a>
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
                                        <a href="categories-6?page=1" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </section>

                </section>

                {{--<div class="row no-margin wrap-text">--}}

                    {{--<!--  News Section  -->--}}
                    {{--<section id="news" class="page">--}}
                        {{--<div class="news-items equal three-columns">--}}
                            {{--<!-- Single News -->--}}
                            {{--<div class="single-news one-item">--}}
                                {{--<article>--}}
                                    {{--<img src="assets/img/news1.jpg" alt="">--}}
                                    {{--<div class="content">--}}
                                        {{--<span class="meta">Entertainment News</span>--}}
                                        {{--<h3>文娱点评</h3>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
                                        {{--<a href="categories-1?page=1" class="btn-pro">Read more</a>--}}
                                    {{--</div>--}}
                                {{--</article>--}}
                            {{--</div>--}}
                            {{--<!-- END Single News -->--}}
                            {{--<div class="single-news one-item">--}}
                                {{--<article>--}}
                                    {{--<img src="assets/img/news2.jpg" alt="">--}}
                                    {{--<div class="content">--}}
                                        {{--<span class="meta">Military analysis</span>--}}
                                        {{--<h3>军事分析</h3>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
                                        {{--<a href="categories-2?page=1" class="btn-pro">Read more</a>--}}
                                    {{--</div>--}}
                                {{--</article>--}}
                            {{--</div>--}}
                            {{--<div class="single-news one-item">--}}
                                {{--<article>--}}
                                    {{--<img src="assets/img/news3.jpg" alt="">--}}
                                    {{--<div class="content">--}}
                                        {{--<span class="meta">Comments on current events</span>--}}
                                        {{--<h3>时事评论</h3>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
                                        {{--<a href="categories-3?page=1" class="btn-pro">Read more</a>--}}
                                    {{--</div>--}}
                                {{--</article>--}}
                            {{--</div>--}}
                            {{--<div class="single-news one-item">--}}
                                {{--<article>--}}
                                    {{--<img src="assets/img/news4.jpg" alt="">--}}
                                    {{--<div class="content">--}}
                                        {{--<span class="meta">Engineering blog</span>--}}
                                        {{--<h3>技术博客</h3>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
                                        {{--<a href="categories-4?page=1" class="btn-pro">Read more</a>--}}
                                    {{--</div>--}}
                                {{--</article>--}}
                            {{--</div>--}}
                            {{--<div class="single-news one-item">--}}
                                {{--<article>--}}
                                    {{--<img src="assets/img/news5.jpg" alt="">--}}
                                    {{--<div class="content">--}}
                                        {{--<span class="meta">Education and Culture</span>--}}
                                        {{--<h3>教育文化</h3>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
                                        {{--<a href="categories-5?page=1" class="btn-pro">Read more</a>--}}
                                    {{--</div>--}}
                                {{--</article>--}}
                            {{--</div>--}}
                            {{--<div class="single-news one-item">--}}
                                {{--<article>--}}
                                    {{--<img src="assets/img/news5.jpg" alt="">--}}
                                    {{--<div class="content">--}}
                                        {{--<span class="meta">All News</span>--}}
                                        {{--<h3>全部分类</h3>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
                                        {{--<a href="categories-6?page=1" class="btn-pro">Read more</a>--}}
                                    {{--</div>--}}
                                {{--</article>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</section>--}}
                    {{--<!-- END News -->--}}
                {{--</div>--}}
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

@section('script')

    <script>
        // $("#filter li[class*='isChecked']")

        var lastSort=1;
        var asc=[1,0,0];

        $("#filter li").click(function(){
            var val=$("#sorter li[class*='is-checked']").val();
            console.log($(this).val());
            console.log(val);
        });

        $("#sorter li").click(function(){
            var filter_val=$("#filter li[class*='is-checked']").val();
            var sort_val=$(this).val();
            if($(this).val()===lastSort){
                asc[sort_val-1]=1-asc[sort_val-1];
            }
            lastSort=sort_val;
            // if(asc[sort_val-1]){
            //     $("#sorter li[class*='is-checked'] i").attr('class','fa fa-fw fa-sort-asc');
            // }
            // else{
            //     $("#sorter li[class*='is-checked'] i").attr('class','fa fa-fw fa-sort-desc');
            // }
            console.log(asc);
            console.log(filter_val);
            console.log(sort_val);
        });
    </script>

@endsection