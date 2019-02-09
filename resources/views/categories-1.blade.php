@extends('layouts.shop')
@section('content')
    <script>
        $(function () {
            $("#categories").addClass("active-item");
        });
    </script>
    <!--  Main Wrap  -->
    <div id="main-wrap">
        <!--  Page Content  -->
        <div id="page-content">
            <!--  Page header  -->
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-12 padding-leftright-null">
                        <div id="page-header">
                            <div class="text">
                                <h1 class="margin-bottom-small">文娱点评<span class="color">.</span></h1>
                                <p class="heading left max full grey-dark">Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Beatae quos rem, error facilis eveniet perspiciatis tempora totam
                                    animi doloribus. Quia officia laudantium dolor sapiente? Dolor maxime voluptatum
                                    sint molestias ipsa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  END Page header  -->
            <div id="home-wrap" class="content-section">
                <div class="container">
                    <!-- Shortcodes -->
                    <div class="row no-margin">
                        <!--  Grid Images with Lightbox  -->
                        <div class="project-images grid text">
                            <div class="col-xs-6 col-sm-3 padding-leftright-null">
                                <div class="image" style="background-image:url(assets/img/news1.jpg)"></div>
                            </div>
                            <div class="col-xs-6 col-sm-3 padding-leftright-null">
                                <div class="image" style="background-image:url(assets/img/news2.jpg)"></div>
                            </div>
                            <div class="col-xs-6 col-sm-3 padding-leftright-null">
                                <div class="image" style="background-image:url(assets/img/news3.jpg)"></div>
                            </div>
                            <div class="col-xs-6 col-sm-3 padding-leftright-null">
                                <div class="image" style="background-image:url(assets/img/news4.jpg)"></div>
                            </div>
                        </div>
                        <!--  END Grid Images with Lightbox  -->
                    </div>
                    <hr>
                    <div class="row no-margin">
                        {{--具体文章--}}

                        <div id="home-wrap" class="content-section">
                            <!-- Blog -->
                            <div class="container">
                                <div class="row no-margin wrap-text">
                                    <!--  News Section  -->
                                    <section id="news" class="page">
                                        <div class="news-items equal three-columns">
                                            @foreach($data as $val)
                                                <div class="single-news one-item">
                                                    <article>
                                                        <img src="assets/img/news1.jpg" alt="">
                                                        <div class="content">
                                                            <span class="meta">All Blog</span>
                                                            <h3>{{$val->title}}<span class="color">.</span></h3>
                                                            <p>
                                                                作者：@foreach($writer as $t)
                                                                    @if($t->id==($val->user_id))
                                                                        {{$t->name}}
                                                                    @endif
                                                                @endforeach
                                                                <br>
                                                                更新于：{{$val->update}}
                                                            </p>
                                                            <a href="article?id={{$val->id}}" class="btn-pro">Read
                                                                more</a>
                                                        </div>
                                                    </article>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <!--  Navigation  -->
                            <section id="nav" class="padding-onlytop-lg">
                                <div class="row">
                                    @if(!$up)
                                        <div class="col-xs-6">
                                            <div class="nav-left">
                                                <a href="/categories-1?page={{$current-1}}"
                                                   class="btn-alt small shadow margin-null"><i
                                                            class="icon ion-ios-arrow-left"></i><span>上一页</span></a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($up==2)
                                        <script>
                                            window.location.href = "/categories-1?page={{$current}}";
                                        </script>
                                        <div class="col-xs-6">
                                            <div class="nav-left">
                                                <a href="/categories-1?page={{$current-1}}"
                                                   class="btn-alt small shadow margin-null invisible"><i
                                                            class="icon ion-ios-arrow-left"></i><span>上一页</span></a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($up==1)
                                        <div class="col-xs-6">
                                            <div class="nav-left">
                                                <a href="/categories-1?page={{$current-1}}"
                                                   class="btn-alt small shadow margin-null invisible"><i
                                                            class="icon ion-ios-arrow-left"></i><span>上一页</span></a>
                                            </div>
                                        </div>
                                    @endif


                                    @if(!$down)
                                        <div class="col-xs-6">
                                            <div class="nav-right">
                                                <a href="/categories-1?page={{$current+1}}"
                                                   class="btn-alt small shadow margin-null"><span>下一页</span><i
                                                            class="icon ion-ios-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($down==2)
                                        <script>
                                            window.location.href = "/categories-1?page={{$current}}";
                                        </script>
                                        <div class="col-xs-6">
                                            <div class="nav-left">
                                                <a href="/categories-1?page={{$current+1}}"
                                                   class="btn-alt small shadow margin-null invisible"><i
                                                            class="icon ion-ios-arrow-left"></i><span>下一页</span></a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($down==1)
                                        <div class="col-xs-6">
                                            <div class="nav-left">
                                                <a href="/categories-1?page={{$current+1}}"
                                                   class="btn-alt small shadow margin-null invisible"><i
                                                            class="icon ion-ios-arrow-left"></i><span>下一页</span></a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        </div>

                        <div class="row margin-null padding-onlytop-md">
                            <div class="col-md-12 padding-leftright-null">
                                <!-- Counters -->
                                <div class="col-md-12 padding-leftright-null">
                                    <div id="counters" class="row padding-md-leftright-null padding-md text-center">
                                        <div class="col-sm-3 padding-md-leftright-null">
                                            <div class="statistic">
                                                <i class="material-icons color service">people</i>
                                                <span data-from="0" data-to="222">&nbsp;</span>
                                                <h3>Clients</h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 padding-md-leftright-null">
                                            <div class="statistic">
                                                <i class="material-icons color service">card_travel</i>
                                                <span data-from="0" data-to="400">&nbsp;</span>
                                                <h3>Experience</h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 padding-md-leftright-null">
                                            <div class="statistic">
                                                <i class="material-icons color service">trending_up</i>
                                                <span data-from="0" data-to="25">&nbsp;</span>
                                                <h3>Goals</h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 padding-md-leftright-null">
                                            <div class="statistic">
                                                <i class="material-icons color service">lightbulb_outline</i>
                                                <span data-from="0" data-to="54">&nbsp;</span>
                                                <h3>Vision</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Counters -->
                            </div>
                        </div>
                    </div>
                    <!-- END Section same Height. Child get the parent Height. Set the same id -->
                    <!-- END Shortcodes -->
                </div>
            </div>
        </div>
        <!--  END Page Content -->
    </div>




@endsection