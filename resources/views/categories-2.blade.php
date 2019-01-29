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
                                <h1 class="margin-bottom-small">军事分析<span class="color">.</span></h1>
                                <p class="heading left max full grey-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae quos rem, error facilis eveniet perspiciatis tempora totam animi doloribus. Quia officia laudantium dolor sapiente? Dolor maxime voluptatum sint molestias ipsa.</p>
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
                    <div class="row no-margin">
                        {{--具体文章--}}
                        <div class="row padding-sm">

                            @foreach($data as $val)
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <a href="article">
                                        <p style="font-size: 30px">{{$val->title}}</p>
                                    </a>
                                </div>
                            @endforeach

                            {{--<div class="col-md-12">--}}
                                {{--<div class="alert alert-success alert-dismissible" role="alert">--}}
                                    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                    {{--<a href="article">--}}
                                        {{--<p style="font-size: 30px">1文章标题</p>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            </div>
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
    <!--  Main W




@endsection