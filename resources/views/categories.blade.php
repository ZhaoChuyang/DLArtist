@extends('layouts.shop')

@section('head')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('content')
    <style>
        #loader {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 1;
            background-color: #fff;
            z-index: 1000;
            text-align: center;
        }


        #loading-image {

            /*vertical-align: middle;*/
            /*z-index: 1000;*/
            max-width: 350px;

            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>
    <script>
        $(function () {
            $("#categories").addClass("active-item");
        });
    </script>
    <div id="loader">
        <img id="loading-image"  src="images/preloader_3.gif" alt="Loading..." />
    </div>
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
                                    <li value='6' class="is-checked">所有文章</li>
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
                        <div id="articles" class="news-items equal three-columns">
                            <div name="article" class="single-news one-item">
                                <article>
                                    <img style="width: 100%;height: 170px" src="assets/img/news1.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">article</span>
                                        <h3>sssssssssssssssssssssssssssssssssss</h3>
                                        <p>ssssssssssssssssssssssssss</p>
                                        <a href="single-post.html" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div name="article" class="single-news one-item">
                                <article>
                                    <img style="width: 100%;height: 170px" src="assets/img/news1.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">article</span>
                                        <h3>sssssssssssssssssssssssssssssssssss</h3>
                                        <p>ssssssssssssssssssssssssss</p>
                                        <a href="single-post.html" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div name="article" class="single-news one-item">
                                <article>
                                    <img style="width: 100%;height: 170px" src="assets/img/news1.jpg" alt="">
                                    <div class="content">
                                        <span class="meta">article</span>
                                        <h3>sssssssssssssssssssssssssssssssssss</h3>
                                        <p>ssssssssssssssssssssssssss</p>
                                        <a href="single-post.html" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div name="article" class="single-news one-item">
                                <article>
                                    <img style="width: 100%;height: 170px" src="" alt="">
                                    <div class="content">
                                        <span class="meta">article</span>
                                        <h3></h3>
                                        <p></p>
                                        <a href="single-post.html" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div name="article" class="single-news one-item">
                                <article>
                                    <img style="width: 100%;height: 170px" src="" alt="">
                                    <div class="content">
                                        <span class="meta">article</span>
                                        <h3></h3>
                                        <p></p>
                                        <a href="single-post.html" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                            <div name="article" class="single-news one-item">
                                <article>
                                    <img style="width: 100%;height: 170px" src="" alt="">
                                    <div class="content">
                                        <span class="meta">article</span>
                                        <h3></h3>
                                        <p></p>
                                        <a href="single-post.html" class="btn-pro">Read more</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </section>
                </section>

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
                                <div  id="left"  class="nav-left">
                                    <a id="pre" href="#"
                                       class="btn-alt small shadow margin-null"><i
                                                class="icon ion-ios-arrow-left"></i><span>上一页</span></a>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div id="right" class="nav-right">
                                    <a id="next" href="#"
                                       class="btn-alt small shadow margin-null"><span>下一页</span><i
                                                class="icon ion-ios-arrow-right"></i></a>
                                </div>
                            </div>
                    </div>
                </section>
                <!--  END Navigation  -->
                <div class="row margin-null padding-onlytop-md">
                    <div class="col-md-12 padding-leftright-null">
                        <!-- Counters -->
                        <div class="col-md-12 padding-leftright-null">
                            <div id="counters" class="row padding-md-leftright-null padding-md text-center">
                                <div class="col-sm-3 padding-md-leftright-null">
                                    <div class="statistic">
                                        <i class="material-icons color service">people</i>
                                        <span data-from="0" data-to="}}">&nbsp;</span>
                                        <h3>用户</h3>
                                    </div>
                                </div>
                                <div class="col-sm-3 padding-md-leftright-null">
                                    <div class="statistic">
                                        <i class="material-icons color service">card_travel</i>
                                        <span data-from="0" data-to="}}">&nbsp;</span>
                                        <h3>文章</h3>
                                    </div>
                                </div>
                                <div class="col-sm-3 padding-md-leftright-null">
                                    <div class="statistic">
                                        <i class="material-icons color service">trending_up</i>
                                        <span data-from="0" data-to="}}">&nbsp;</span>
                                        <h3>新增</h3>
                                    </div>
                                </div>
                                <div class="col-sm-3 padding-md-leftright-null">
                                    <div class="statistic">
                                        <i class="material-icons color service">lightbulb_outline</i>
                                        <span data-from="0" data-to="4">&nbsp;</span>
                                        <h3>开发人员</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Counters -->
                    </div>
                </div>
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
        $(window).load(function(){
            // PAGE IS FULLY LOADED
            // FADE OUT YOUR OVERLAYING DIV
            $('#loader').fadeOut();
        });
        var page=1;
        var category_val=6;
        var sorter_val=1;

        var lastSort=1;
        var asc=[1,0,0];

        function search(){
            $.ajax({
                url:'categories/sorter',
                type:'post',
                data:{
                    "_token": '{{csrf_token()}}',
                    'page':page,
                    'category_val':category_val,
                    'sorter_val':sorter_val,
                    'asc':asc
                },
                dataType: 'json',
                success:function (response) {
                    var next=response.next_page;
                    var pre=response.pre_page;
                    var data=response.data;
                    for (var i=0;i<data.length;i++){
                        $("div[name='article']").eq(i).show();
                        $("div[name='article']>article>img").eq(i).attr('src',data[i]. cover_url);
                        $("div[name='article']>article>div>h3").eq(i).html(data[i].title);
                        $("div[name='article']>article>div>p").eq(i).html("作者："+data[i].name+"<br>发表于："+data[i].update);
                        $("div[name='article']>article>div>a").eq(i).attr('href',"/article/"+data[i].id);
                    }
                    for(var j=data.length;j<6;j++){
                        $("div[name='article']").eq(j).hide();
                    }
                    if(next===false){
                        $("#right").hide();
                    }
                    else  $("#right").show();
                    if(pre==false) {
                        $("#left").hide();
                    }
                    else  $("#left").show();
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        }

        window.onload=search();

        $("#filter li").click(function () {
            sorter_val=$("#sorter li[class*='is-checked']").val();
            category_val=$(this).val();
            page=1;
            search();
        });

        $("#next").click(function () {
            page++;
            search();
            return false;
        });

        $("#pre").click(function () {
            page--;
            search();
            return false;
        });

        $("#sorter li").click(function(){
            category_val=$("#filter li[class*='is-checked']").val();
            sorter_val=$(this).val();
            if($(this).val()===lastSort){
                asc[sorter_val-1]=1-asc[sorter_val-1];
            }
            lastSort=sorter_val;
            page=1;

            search();
        });
    </script>

@endsection