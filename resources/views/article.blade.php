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

                    <div class="col-md-10 col-md-offset-1 padding-leftright-null">
                        <embed src="/pdf/{{$article_id}}" style="width: 100%; height: 1000px;"
                               type="application/pdf">
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
                                    <li role="presentation" class="active"><a href="#tab-one" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true" id="all_comments">所有评论</a></li>
                                    <li role="presentation" class=""><a href="#tab-two" aria-controls="tab-two" role="tab" data-toggle="tab" aria-expanded="false" id="second">评论</a></li>
                                </ul>
                                <!--  Nav Tabs  -->
                                <!-- Tab panes -->
                                <div class="tab-content no-margin-bottom">
                                    <div role="tabpanel" class="tab-pane padding-md active" id="tab-one">
                                        <div id="tab-one-content">
                                        @if($comment_num)
                                            @foreach($comments as $t)
                                                <input type="text" name="reply_id" style="display: none" value="{{$t->id}}">
                                                <input type="text" name="reply_name" style="display: none" value="{{$t->name}}">
                                                <div class="comment">
                                                    <div class="row margin-null">
                                                        <div class="col-md-12 padding-leftright-null">
                                                            <img src="{{$t->avatar_url}}" alt="">
                                                            <div class="content">
                                                                <div class="header">
                                                                    <span class="comment-author">
                                                                        {{$t->name}}
                                                                    </span>
                                                                    <span class="comment-btn">
                                                                        <a href="#" name="reply"><i class="material-icons">reply</i></a>
                                                                    </span>
                                                                </div>
                                                                <span class="comment-date">
                                                                    {{$t->update}}
                                                            </span>
                                                                <p>{{$t->content}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($reply as $m)
                                                    @if($m->id==$t->id)
                                                    <div class="comment reply">
                                                        <div class="row margin-null">
                                                            <div class="col-md-10 col-md-offset-2 padding-leftright-null">
                                                                <img src="{{$m->avatar_url}}" alt="">
                                                                <div class="content">
                                                                    <div class="header">
                                                                    <span class="comment-author">
                                                                         {{$m->name}}
                                                                    </span>
                                                                        <span class="comment-btn">
                                                                        {{--<a href="#"><i class="material-icons">reply</i></a>--}}
                                                                    </span>
                                                                    </div>
                                                                    <span class="comment-date">
                                                                    {{$m->update}}
                                                                </span>
                                                                    <p>{{$m->content}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                        @if($comment_num==0)
                                            <h2>还没有评论哦！</h2>
                                        @endif
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane padding-md " id="tab-two">
                                        @if($user_id!=-1)
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
                                        @endif
                                        @if($user_id==-1)
                                            <h2>您还没有登录哦！</h2>
                                        @endif
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

    <input type="hidden" id="writer_id" value="{{$user_id}}">
    <input type="hidden" id="article_id" value="{{$id}}">
    <script>
        var reply_id=new Array();
        var reply_name=new Array();
        var reply=false;
        var index;
        $.each($("input[name='reply_id']"),function (index,value) {
            reply_id[index]=$("input[name='reply_id']").eq(index);
        });
        $.each($("input[name='reply_name']"),function (index,value) {
            reply_name[index]=$("input[name='reply_name']").eq(index);
        });
        $("#tab-one").delegate("a[name='reply']",'click',function () {
           reply=true;
           $("#second").trigger('click');
           index=$("a[name='reply']").index($(this));
           $("#messageForm").attr('placeholder',"回复 "+reply_name[index].val());
           return false;
       })
        $("#all_comments").click(function(){
            reply=false;
            $.each($("input[name='reply_id']"),function (index,value) {
                reply_id[index]=$("input[name='reply_id']").eq(index);
            });
            $.each($("input[name='reply_name']"),function (index,value) {
                reply_name[index]=$("input[name='reply_name']").eq(index);
            });
        });
        $("#second").click(function () {
            reply=false;
            $("#messageForm").attr('placeholder',"Your messages");
        });
        $("#submit-contact").click(function () {
            if(!reply){
                $.ajax({
                    url: '/ArticleController/comment',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',
                        "user_id": $("#writer_id").val(),
                        "content": $("#messageForm").val(),
                        "article_id":$("#article_id").val()
                    },
                    dataType: 'json',
                    success: function (response) {
                        alert("评论成功");
                        $("#messageForm").val('');
                        console.log(response);
                        $('#tab-one').load(document.URL +  ' #tab-one-content');
                    },
                    error: function (xhr) {
                        alert(456);
                        console.log(xhr);
                    }
                });
            }
            else {
                $.ajax({
                    url: '/ArticleController/comment_reply',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',
                        "id": reply_id[index].val(),
                        'reply_name': reply_name[index].val(),
                        "user_id": $("#writer_id").val(),
                        "content": $("#messageForm").val(),
                        "article_id":$("#article_id").val()
                    },
                    dataType: 'json',
                    success: function (response) {
                        alert("回复成功");
                        $("#messageForm").val('');
                        console.log(response);
                        $('#tab-one').load(document.URL +  ' #tab-one-content');
                    },
                    error: function (xhr) {
                        alert(456);
                        console.log(xhr);
                    }
                });
            }
        });





    </script>

@endsection