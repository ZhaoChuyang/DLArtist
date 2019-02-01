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
                        <div class="text text-center">
                            {{--//标题（需要dom标签）--}}
                            <h1 class="margin-bottom-small">
                                @foreach($title as $t)
                                    {{$t->title}}
                                @endforeach
                                <span class="color">.</span></h1>
                            {{--//发表时间--}}
                            <h5 class="post-meta">
                                作者：{{$user_name->name}}
                                <br>  <br>
                                更新于：
                                @foreach($time as $t)
                                    {{$t->update}}
                                @endforeach

                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END Page header  -->
        <div id="home-wrap" class="content-section">

            <div class="container">
                <hr style="border: solid">
            </div>
            <!-- Post Content -->
            <div class="container">
                <div class="row no-margin wrap-text padding-bottom-null padding-onlytop-lg">
                    <div class="col-md-8 col-md-offset-2 padding-leftright-null">
                        <div class="text small padding-topbottom-null">
                            <span class="dropcap" data-dropcap="DLARTIST"></span>
                            {{--//文章内容（无需dom标签）--}}
                            @foreach($content as $t)
                                {!! $t->content !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Post Content -->



            <div class="container">
                <hr style="border: solid">
            </div>

            <!-- Full width Border Separator -->
            <div class="row no-margin">
                <div class="border-separator"></div>
            </div>
            <!-- END Full Width Border Separator -->
            <div class="container">
                <!--  Comments  -->
                <div class="row no-margin wrap-text padding-onlytop-lg">
                    <div class="col-md-8 col-md-offset-2 padding-leftright-null">
                        <div class="text small padding-topbottom-null">
                            <div id="comments">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab-one" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true">所有评论</a></li>
                                    <li role="presentation" class=""><a href="#tab-two" aria-controls="tab-two" role="tab" data-toggle="tab" aria-expanded="false">评论</a></li>
                                </ul>
                                <!--  Nav Tabs  -->
                                <!-- Tab panes -->
                                <div class="tab-content no-margin-bottom">
                                    <div role="tabpanel" class="tab-pane padding-md active" id="tab-one">
                                        <div class="comment">
                                            <div class="row margin-null">
                                                <div class="col-md-12 padding-leftright-null">
                                                    <img src="assets/img/comment3.jpg" alt="">
                                                    <div class="content">
                                                        <div class="header">
                                                                    <span class="comment-author">
                                                                        Asia Rossi
                                                                    </span>
                                                            <span class="comment-btn">
                                                                        <a href="#"><i class="material-icons">reply</i></a>
                                                                    </span>
                                                        </div>
                                                        <span class="comment-date">
                                                                    12 November 2017
                                                                </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti quo fuga corporis sunt voluptate, quia, beatae voluptates est possimus impedit eveniet quaerat nulla sapiente. Omnis odit quas est fuga nam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment reply">
                                            <div class="row margin-null">
                                                <div class="col-md-10 col-md-offset-2 padding-leftright-null">
                                                    <img src="assets/img/comment1.jpg" alt="">
                                                    <div class="content">
                                                        <div class="header">
                                                                    <span class="comment-author">
                                                                        Joe Doe
                                                                    </span>
                                                            <span class="comment-btn">
                                                                        <a href="#"><i class="material-icons">reply</i></a>
                                                                    </span>
                                                        </div>
                                                        <span class="comment-date">
                                                                    12 November 2017
                                                                </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti quo fuga corporis sunt voluptate, quia, beatae voluptates est possimus impedit eveniet quaerat nulla sapiente. Omnis odit quas est fuga nam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment">
                                            <div class="row">
                                                <div class="col-md-12 padding-leftright-null">
                                                    <img src="assets/img/comment2.jpg" alt="">
                                                    <div class="content">
                                                        <div class="header">
                                                                    <span class="comment-author">
                                                                        Jessica Brown
                                                                    </span>
                                                            <span class="comment-btn">
                                                                        <a href="#"><i class="material-icons">reply</i></a>
                                                                    </span>
                                                        </div>
                                                        <span class="comment-date">
                                                                    12 November 2017
                                                                </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti quo fuga corporis sunt voluptate, quia, beatae voluptates est possimus impedit eveniet quaerat nulla sapiente. Omnis odit quas est fuga nam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane padding-md" id="tab-two">
                                        <section class="comment-form">
                                            <form id="contact-form" name="comment">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">评论<sup>*</sup></label>
                                                        <textarea class="form-field" name="messageForm" id="messageForm" rows="6" placeholder="Your Message"></textarea>
                                                        <div class="submit-area">
                                                            <input type="submit" id="submit-contact" class="btn-alt active" value="发表">
                                                            <div id="msg" class="message"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  END Comments  -->
            </div>
        </div>

        {{--//返回上一页--}}
        <div class="container">
            <!--  Navigation  -->
            <section id="nav" class="padding-onlytop-lg">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="nav-left">
                            <a href=”#” onClick="javascript :history.back(-1);" class="btn-alt small shadow margin-null"><i class="icon ion-ios-arrow-left"></i><span>返回</span></a>
                        </div>
                    </div>
                    {{--<div class="col-xs-6">--}}
                    {{--<div class="nav-right">--}}
                    {{--<a href="#" class="btn-alt small shadow margin-null"><span>Newer posts</span><i class="icon ion-ios-arrow-right"></i></a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </section>
        </div>

    </div>
    <!--  END Page Content -->
    </div>


@endsection