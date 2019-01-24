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
                            <h1 class="margin-bottom-small">This is a post<span class="color">.</span></h1>
                            <span class="post-meta">News \ 02 November 2017</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END Page header  -->
        <div id="home-wrap" class="content-section">
            <!-- Main Img -->
            <div class="container">
                <div class="row no-margin wrap-text padding-onlytop-sm">
                    <div class="col-md-12 padding-leftright-null">
                        <div class="text small padding-topbottom-null">
                            <img src="assets/img/news1.jpg" alt="" class="img-post">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Main Img -->
            <!-- Post Content -->
            <div class="container">
                <div class="row no-margin wrap-text padding-bottom-null padding-onlytop-lg">
                    <div class="col-md-8 col-md-offset-2 padding-leftright-null">
                        <div class="text small padding-topbottom-null">
                            <p><span class="dropcap" data-dropcap="L">L</span>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Donec elementum ligula eu sapien consequat eleifend. Donec nec dolor erat, condimentum sagittis sem. Praesent porttitor porttitor risus, dapibus rutrum ipsum.
                            </p>
                            <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                <cite><a href="#">Joe Doe</a></cite>
                            </blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Post Content -->
            <!-- Related Img -->
            <div class="container">
                <div class="row no-margin wrap-text padding-onlytop-sm padding-onlytop-sm">
                    <div class="col-md-12 padding-leftright-null">
                        <div class="text small padding-topbottom-null">
                            <img src="assets/img/news2.jpg" alt="" class="img-post">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Related Img -->
            <!-- Other Content -->
            <div class="container">
                <div class="row no-margin wrap-text padding-onlybottom-lg">
                    <div class="col-md-8 col-md-offset-2 padding-leftright-null">
                        <div class="text small padding-bottom-null">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.</p>
                            <div class="post-links padding-onlytop-sm">
                                <span>Posted in <a href="">Case History</a> and tagged <a href="">Brand</a>, <a href="">News</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Other Content -->
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
                                    <li role="presentation" class="active"><a href="#tab-one" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true">All comments</a></li>
                                    <li role="presentation" class=""><a href="#tab-two" aria-controls="tab-two" role="tab" data-toggle="tab" aria-expanded="false">Leave a comment</a></li>
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
                                            <form id="contact-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Name <sup>*</sup></label>
                                                        <input class="form-field" name="name" id="name" type="text" placeholder="Your name">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Email <sup>*</sup></label>
                                                        <input class="form-field" name="mail" id="mail" type="text" placeholder="Your Email">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Message <sup>*</sup></label>
                                                        <textarea class="form-field" name="messageForm" id="messageForm" rows="6" placeholder="Your Message"></textarea>
                                                        <div class="submit-area">
                                                            <input type="submit" id="submit-contact" class="btn-alt active" value="Submit">
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
    </div>
    <!--  END Page Content -->
    </div>


@endsection