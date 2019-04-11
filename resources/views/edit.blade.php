@extends('layouts.edit')

@section('loader')
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

    <div id="loader">
        <img id="loading-image" src="images/preloader_3.gif" alt="Loading..."/>
    </div>
@endsection

@section('head')
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <!-- Include Editor style. -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="froala_editor_2.9.1/css/froala_style.min.css" rel="stylesheet"
          type="text/css"/>

    <!-- Include TUI CSS. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tui-image-editor@3.2.2/dist/tui-image-editor.css">
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.css">

    <!-- Include TUI Froala Editor CSS. -->
    <link rel="stylesheet" href="froala_editor_2.9.1/css/third_party/image_tui.min.css">

    <!--smart wizard-->
    <link rel="stylesheet" href="smart_wizard/smart_wizard.css">
    <link rel="stylesheet" href="smart_wizard/smart_wizard_theme_arrows.min.css">
    <link rel="stylesheet" href="smart_wizard/smart_wizard_theme_dots.min.css">

    <style>
        body {
            font-size: .875rem;
        }

        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
        }

        /*
         * Sidebar
         */

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100; /* Behind the navbar */
            padding: 48px 0 0; /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        @supports ((position: -webkit-sticky) or (position: sticky)) {
            .sidebar-sticky {
                position: -webkit-sticky;
                position: sticky;
            }
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }

        /*
         * Content
         */

        [role="main"] {
            padding-top: 48px; /* Space for fixed navbar */
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
        }

        .navbar .form-control {
            padding: .75rem 1rem;
            border-width: 0;
            border-radius: 0;
        }

        .form-control-dark {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }


    </style>

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar mt-2">
                <div class="sidebar-sticky">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>编辑本文</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-plus-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                        </a>
                    </h6>
                    <ul class="nav flex-column" id="sideNav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="edit_button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-activity">
                                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                </svg>
                                编辑文章 <span class="sr-only">(current)</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" id="compose_view_button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-activity">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                自动排版
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" data-toggle="collapse" data-target="#submenu-1" class="nav-link"
                               id="image_edit_button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-activity">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                图片美化
                            </a>

                            <ul id="submenu-1" class="collapse">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="fgqy_button">
                                        风格迁移
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="image_manage_button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-activity">
                                    <path d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z"></path>
                                    <polyline points="2.32 6.16 12 11 21.68 6.16"></polyline>
                                    <line x1="12" y1="22.76" x2="12" y2="11"></line>
                                </svg>
                                图片管理
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>历史编辑</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-plus-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        {{--<li>--}}
                        {{--<a href="#" data-toggle="collapse" data-target="#submenu-1" class="nav-link">--}}
                        {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                        {{--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                        {{--stroke-linejoin="round" class="feather feather-plus-circle">--}}
                        {{--<circle cx="12" cy="12" r="10"></circle>--}}
                        {{--<line x1="12" y1="8" x2="12" y2="16"></line>--}}
                        {{--<line x1="8" y1="12" x2="16" y2="12"></line>--}}
                        {{--</svg>--}}
                        {{--下拉菜单--}}
                        {{--</a>--}}
                        {{--<ul id="submenu-1" class="collapse">--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">--}}
                        {{--Current month--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">--}}
                        {{--Current month--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">--}}
                        {{--Current month--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Last quarter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Social engagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Year-end sale
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
                <div class="chartjs-size-monitor"
                     style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand"
                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink"
                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                    </div>
                </div>
                {{--消息提醒--}}
                <div class="alert alert-info alert-dismissible collapse" role="alert" id="cover">封面已上传
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="edit_view">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h1 class="h2 ml-4">Edit</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <label class="btn btn-outline-secondary btn-sm" id="show_cover" data-toggle="modal"
                                       data-target="#exampleModal1">
                                    查看封面
                                </label>

                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">文章封面</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img id="cover_img_preview" class="img-thumbnail " style="max-height: 300px; max-width: 400px;     display:block;
    margin:auto;" src="/images/blog_cover.jpg">
                                            </div>
                                            <div class="modal-footer">
                                                <label class="btn btn-primary ml-2">
                                                    选择图片<input id="cover_file" name="avatar" type="file" hidden>
                                                </label>
                                                <label class="btn btn-secondary ml-2" data-dismiss="modal">
                                                    关闭窗口
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="btn btn-sm btn-outline-secondary">Share</label>
                                <label class="btn btn-sm btn-outline-secondary">Export</label>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span id="shareStatus">私密发布</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <input type="text" hidden value="0" id="shareValue">
                                    <a class="dropdown-item" href="#" id="privateStatus">私密发布</a>
                                    <a class="dropdown-item" href="#" id="publicStatus">公开发布</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form class="ml-4">
                        <div class="form-group row">
                            <label for="title" class="col-sm-1 col-form-label"><strong>标题</strong></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control w-50" id="title" placeholder="请输入标题"
                                       style="border: 0;">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="category" class="col-sm-1 col-form-label"><strong>分类</strong></label>
                            <div class="col-sm-10">
                                <select id="category" class="custom-select w-50">
                                    <option value="0" selected>请选择类别</option>
                                    <option value="文娱点评">文娱点评</option>
                                    <option value="军事分析">军事分析</option>
                                    <option value="时事评论">时事评论</option>
                                    <option value="技术博客">技术博客</option>
                                    <option value="教育文化">教育文化</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="edit" class="col-sm-1 col-form-label"><strong>内容</strong></label>
                            <div class="col-sm-10">
                                <textarea id="edit" name="content"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label class="col-sm-1 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-primary" id="send">发表文章</button>
                                <br>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="image_view" class="mb-4">
                    <h1 class="h2 ml-5">风格迁移</h1>
                    <div id="smartwizard" class="ml-5 mt-4">

                        <ul id="wizard_li">
                            <li class="ml-5"><a href="#step-1" class="">Step 1<br/>
                                    <small>上传图片</small>
                                </a></li>
                            <li class="ml-5"><a href="#step-2" class="">Step 2<br/>
                                    <small>选择风格</small>
                                </a></li>
                            <li class="ml-5"><a href="#step-3" class="">Step 3<br/>
                                    <small>生成图片</small>
                                </a></li>
                        </ul>

                        <div class="mt-4">
                            <div id="step-1" class="ml-3">
                                <h3 class="border-bottom border-gray pb-2">Step 1 上传图片</h3>
                                <form id="form1" runat="server">
                                    <label class="btn btn-outline-secondary btn-sm" id="cover_upload">
                                        上传图片<input id="imgInp" name="avatar" type="file" hidden>
                                    </label>
                                    <br>
                                    <img id="content" src="#" alt="your image" class="border p-2 rounded collapse"
                                         style="max-width: 300px; max-height: 300px;"/>
                                </form>
                            </div>
                            <div id="step-2" class="ml-3">
                                <h3 class="border-bottom border-gray pb-2">Step 2 选择风格</h3>
                                <form id="form1" runat="server">
                                    <label class="btn btn-outline-secondary btn-sm" id="cover_upload">
                                        上传图片<input id="imgInp2" name="avatar" type="file" hidden>
                                    </label>
                                    <br>
                                    <img id="style" src="#" alt="your image" class="border p-2 rounded collapse"
                                         style="max-width: 800px; max-height: 800px;"/>
                                </form>
                            </div>
                            <div id="step-3" class="ml-3">
                                {{--<div class="row">--}}
                                {{--<div class="col">--}}
                                {{--<img id="content_copy" src="#" alt="your image" class="border p-2 rounded" style="max-width: 300px; max-height: 300px;"/>--}}
                                {{--</div>--}}
                                {{--<div class="col">--}}
                                {{--<img id="style_copy"src="#" alt="your image" class="border p-2 rounded" style="max-width: 300px; max-height: 300px;"/>--}}
                                {{--</div>--}}
                                {{--<div class="col">--}}
                                {{--<canvas id="stylized" width="192" height="256" class="image mt-2 border p-2 rounded"></canvas>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <h3 class="border-bottom border-gray pb-2">Step 3 生成图片</h3>
                                <button id="stylize" class="btn btn-outline-secondary btn-sm">提交图片</button>
                                <br>
                                <canvas id="stylized" width="192" height="256"
                                        class="image mt-2 border p-2 rounded"></canvas>
                                <br>
                            </div>
                        </div>


                    </div>

                </div>

                <div id="compose_view">
                    <style>
                        .product-device {
                            position: absolute;
                            right: 10%;
                            bottom: -30%;
                            width: 300px;
                            height: 540px;
                            background-color: #333;
                            border-radius: 21px;
                            -webkit-transform: rotate(30deg);
                            transform: rotate(30deg);
                        }

                        .product-device::before {
                            position: absolute;
                            top: 10%;
                            right: 10px;
                            bottom: 10%;
                            left: 10px;
                            content: "";
                            background-color: rgba(255, 255, 255, .1);
                            border-radius: 5px;
                        }

                        .product-device-2 {
                            top: -25%;
                            right: auto;
                            bottom: 0;
                            left: 5%;
                            background-color: #e5e5e5;
                        }

                        /*
                         * Extra utilities
                         */

                        .flex-equal > * {
                            -ms-flex: 1;
                            flex: 1;
                        }

                        @media (min-width: 768px) {
                            .flex-md-equal > * {
                                -ms-flex: 1;
                                flex: 1;
                            }
                        }

                        .overflow-hidden {
                            overflow: hidden;
                        }
                    </style>
                    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
                        <div class="col-md-5 p-lg-5 mx-auto my-5">
                            <h1 class="display-4 font-weight-normal">智能排版</h1>
                            <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your
                                marketing efforts with this example based on Apple’s marketing pages.</p>
                            <a class="btn btn-outline-secondary" href="#" id="compose" data-toggle="modal"
                               data-target="#compose_modal">开始排版</a>
                        </div>
                        <div class="product-device shadow-sm d-none d-md-block"></div>
                        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
                    </div>
                </div>

                <div id="image_manage_view">
                    <div class="row ml-4 mt-4">
                        <div class="col-2 ">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                   role="tab" aria-controls="v-pills-home" aria-selected="true">人物</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                   role="tab" aria-controls="v-pills-profile" aria-selected="false">动物</a>
                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                   href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                   aria-selected="false">食物</a>
                                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill"
                                   href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                   aria-selected="false">物品</a>
                                <a class="nav-link" id="v-pills-person-tab" data-toggle="pill" href="#v-pills-person"
                                   role="tab" aria-controls="v-pills-person" aria-selected="false">出行</a>
                                <a class="nav-link" id="v-pills-undef-tab" data-toggle="pill" href="#v-pills-undef"
                                   role="tab" aria-controls="v-pills-undef" aria-selected="false">默认</a>
                            </div>
                        </div>
                        <div class="col-9  border-left">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                     aria-labelledby="v-pills-home-tab">

                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                     aria-labelledby="v-pills-profile-tab">

                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                     aria-labelledby="v-pills-messages-tab">

                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                     aria-labelledby="v-pills-settings-tab">

                                </div>
                                <div class="tab-pane fade" id="v-pills-person" role="tabpanel"
                                     aria-labelledby="v-pills-person-tab">

                                </div>
                                <div class="tab-pane fade" id="v-pills-undef" role="tabpanel"
                                     aria-labelledby="v-pills-person-tab">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" id="showModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" hidden>
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">相似图片</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="$('#modalImg').empty()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalImg">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="$('#modalImg').empty()">Close
                    </button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade bd-example-modal-lg" id="compose_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">排版方案</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="">
                    <div class="progress" id="progressDiv">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                             role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                             style="width: 0%"></div>
                    </div>
                    <div id="compose_plan">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" id="showAttn" class="btn btn-primary" data-toggle="modal" data-target="#attn_modal">
        Launch demo modal
    </button>
    <div class="modal fade bd-example-modal" id="attn_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">出图结果</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="">
                    <img src="#" id="attn_img" class="img-thumbnail" style="width: 200px; height: 200px;display:block;
    margin:auto;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <img src="images/dog.jpg" id="img" hidden>
    <img src="#" id="img_rec" crossorigin="anonymous" hidden>
    <input type="text" id="result" value="None" style="display: none"></input>

    <div class="col-3 offset-3">
        <style>
            .box9 {
                background: #000;
                text-align: center;
                position: relative
            }

            .box9 img {
                width: 100%;
                height: auto
            }

            .box9:hover img {
                opacity: .5
            }

            .box9 .box-content {
                padding: 30px 10px 30px 0;
                background: rgba(0, 0, 0, .65);
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                opacity: 0
            }

            .box9:hover .box-content {
                top: 10px;
                left: 10px;
                bottom: 10px;
                right: 10px;
                opacity: 1
            }

            .box9 .title {
                font-weight: 700;
                color: #fff;
                line-height: 17px;
                margin: 5px 0;
                position: absolute;
                bottom: 55%
            }

            .box10 .icon li a, .box9 .icon li a {
                line-height: 35px;
                border-radius: 50%
            }

            .box9 .icon {
                list-style: none;
                padding: 0;
                margin: 0;
                position: absolute;
                top: 50%
            }

            .box9 .icon li {
                display: inline-block;
                opacity: 0;
                transform: translateY(40px)
            }

            .box9:hover .icon li {
                opacity: 1;
                transform: translateY(0)
            }

            .box9:hover .icon li:first-child {
                transition-delay: .0s
            }

            .box9:hover .icon li:nth-child(2) {
                transition-delay: .0s
            }

            .box9 .icon li a {
                display: block;
                width: 35px;
                height: 35px;
                background: #f39c12;
                font-size: 20px;
                color: #000;
                margin-right: 5px;
                transition: all .35s ease 0s
            }

            .box9 .icon a:hover {
                background: #fff
            }

            @media only screen and (max-width: 990px) {
                .box9 {
                    margin-bottom: 20px
                }
            }
        </style>
        <div class="box9">
            <img src="http://bestjquery.com/tutorial/hover-effect/demo147/images/img-1.jpg">
            <div class="box-content">
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
        </div>
    </div>





@endsection

@section('script')

    <!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
    <!-- Include Editor JS files. -->
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/froala_editor.min.js"></script>

    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/print.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/entities.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/file.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/quote.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/table.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/save.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/video.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/languages/zh_cn.js"></script>

    <!-- Include TUI JS. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.7/fabric.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/tui-code-snippet@1.4.0/dist/tui-code-snippet.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/tui-image-editor@3.2.2/dist/tui-image-editor.min.js"></script>

    <!-- Include TUI plugin. -->
    <script type="text/javascript" src="froala_editor_2.9.1/js/third_party/image_tui.min.js"></script>
    <!--Math Type-->
    <script src="froala_wiris/wiris.js"></script>
    <script src="froala_wiris/WIRISplugin.js"></script>

    <!--smart wizard-->
    <script src="smart_wizard/jquery.smartWizard.min.js"></script>

    <!--风格迁移-->
    <script src="modelFile/arbitrary_stylization_bundle.js"></script>

    <!--模型类别推断-->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.13.5"></script>
    <script src="modelFile/cocossd.js"></script>

    {{--<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.11.7"> </script>--}}
    <script src="modelFile/mobilenet.js"></script>

    <script>


        $('#compose').click(function () {

        });


        //window loader
        $(window).load(function () {
            // PAGE IS FULLY LOADED
            // FADE OUT YOUR OVERLAYING DIV
            $('#loader').fadeOut();
        });

        async function func() {
            const img = document.getElementById('img');
            var src = $('#img').attr('src');
            var clas;
            cocoSsd.load().then(model => {

                model.detect(img).then(predictions => {
                    // result = document.getElementById('result');
                    // result.innerHTML = predictions[0].class;
                    console.log(predictions);
                    clas = predictions[0].class;
                    $.ajax({
                        url: "image/class",
                        method: "post",
                        datatype: "json",
                        data: {
                            "_token": '{{csrf_token()}}',
                            "src": src,
                            "class": clas,
                        },
                        success: function (response) {
                            console.log(response);
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });
                });

            });
        }

        async function func_1() {
            const img = document.getElementById('img_rec');
            mobilenet.load().then(model => {
                // Classify the image.
                model.classify(img).then(predictions => {
                    //predictions是一个对象数组
                    //数组中的每一个对象 的属性是className、probably ...
                    //可使用 console控制台打印查看详细信息
                    top0 = predictions[0];
                    res = document.getElementById("result");
                    res.value = top0.className;
                    $.ajax({
                        type: "post",
                        url: "/model/image",
                        data: {
                            "_token": '{{csrf_token()}}',
                            "query": $("#result").val()
                        },
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response.value);
                            var temp;
                            if (response.value.length === 0) {
                                $('#modalImg').append("<p>无法识别图片</p>");
                            }
                            for (var i = 0; i < 12; i++) {
                                $('#modalImg').append('<a href="' + response.value[i].contentUrl + '" target="_blank"><img src="' + response.value[i].contentUrl + '" class="img-thumbnail ml-2 mt-2" style="height: 100px; width: 100px;"></a>')
                                //console.log(response.value[i].contentUrl);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    })
                });
            });

        }
    </script>

    <script>

        //风格迁移图片预览
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#content').attr('src', e.target.result);
                    $('#content_copy').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
            $('#content').show();
        });

        function readURL2(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#style').attr('src', e.target.result);
                    $('#style_copy').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp2").change(function () {
            readURL2(this);
            $('#style').show();
        });

        function readURL3(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cover_img_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#cover_file").change(function () {
            readURL3(this);
        });

        function loadImageManagement() {

            $('#v-pills-tabContent div').empty();

            $.ajax({
                url: "image/image_management",
                method: "post",
                data: {
                    "_token": '{{csrf_token()}}',
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    for (var i = 0; i < response.length; i++) {
                        var clas = response[i].class;
                        var src = response[i].src;
                        if (clas === 'person') {
                            $('#v-pills-home').append('<a href="' + clas + '" target="_blank"><img src="' + src + '" class="img-thumbnail ml-2 mt-2" style="height: 200px; width: 200px;"></a>')
                        }
                        if (clas === 'animal') {
                            $('#v-pills-profile').append('<a href="' + clas + '" target="_blank"><img src="' + src + '" class="img-thumbnail ml-2 mt-2" style="height: 200px; width: 200px;"></a>')
                        }
                        if (clas === 'food') {
                            $('#v-pills-messages').append('<a href="' + clas + '" target="_blank"><img src="' + src + '" class="img-thumbnail ml-2 mt-2" style="height: 200px; width: 200px;"></a>')
                        }
                        if (clas === 'item') {
                            $('#v-pills-settings').append('<a href="' + clas + '" target="_blank"><img src="' + src + '" class="img-thumbnail ml-2 mt-2" style="height: 200px; width: 200px;"></a>')
                        }
                        if (clas === 'traffic') {
                            $('#v-pills-person').append('<a href="' + clas + '" target="_blank"><img src="' + src + '" class="img-thumbnail ml-2 mt-2" style="height: 200px; width: 200px;"></a>')
                        }
                        if (clas === 'undefined') {
                            $('#v-pills-undef').append('<a href="' + clas + '" target="_blank"><img src="' + src + '" class="img-thumbnail ml-2 mt-2" style="height: 200px; width: 200px;"></a>')
                        }
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        }

        $(document).ready(function () {
            $('#editMenu').addClass('active');
            $('#image_view').hide();
            $('#compose_view').hide();
            $('#image_manage_view').hide();
            $('#smartwizard').smartWizard({
                selected: 0,  // Initial selected step, 0 = first step
                keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                autoAdjustHeight: true, // Automatically adjust content height
                cycleSteps: false, // Allows to cycle the navigation of steps
                backButtonSupport: true, // Enable the back button support
                useURLhash: true, // Enable selection of the step based on url hash
                lang: {  // Language variables
                    next: 'Next',
                    previous: 'Previous'
                },
                toolbarSettings: {
                    toolbarPosition: 'bottom', // none, top, bottom, both
                    toolbarButtonPosition: 'right', // left, right
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    // toolbarExtraButtons: [
                    //     $('<button></button>').text('Finish')
                    //         .addClass('btn btn-info')
                    //         .on('click', function(){
                    //             alert('Finsih button click');
                    //         }),
                    //     $('<button></button>').text('Cancel')
                    //         .addClass('btn btn-danger')
                    //         .on('click', function(){
                    //             $('#smartwizard').smartWizard("reset");
                    //             $('#wizard_li li').addClass('ml-5');
                    //             return true;
                    //         })
                    // ]
                },
                anchorSettings: {
                    anchorClickable: true, // Enable/Disable anchor navigation
                    enableAllAnchors: false, // Activates all anchors clickable all times
                    markDoneStep: true, // add done css
                    enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                },
                contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                disabledSteps: [],    // Array Steps disabled
                errorSteps: [],    // Highlight step with errors
                theme: 'dots',
                transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                transitionSpeed: '400'
            });
            uploadFlag = 0;
            lastUploadArticle = 0;
            composeFlag = 0;

            //智能图库
            loadImageManagement();
        });


    </script>

    <!-- Initialize the editor. -->
    <script>
        //是否排版
        composeFlag = 0;
        //最后一次上传的文章的id
        var lastUploadArticle = 0;
        //神奇bug解决
        var uploadFlag = 0;
        //未保存提示
        var formSubmitting = false;
        var setFormSubmitting = function () {
            formSubmitting = true;
        };

        window.onload = function () {
            window.addEventListener("beforeunload", function (e) {
                if (formSubmitting) {
                    return undefined;
                }

                var confirmationMessage = 'It looks like you have been editing something. '
                    + 'If you leave before saving, your changes will be lost.';

                (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
            });
        };

        $('#edit_button').click(function () {
            $('#image_view').hide();
            $('#compose_view').hide();
            $('#image_manage_view').hide();
            //the other views should be hide too
            $('#edit_view').show();

            $("#sideNav a[class*='active']").removeClass('active');
            $('#edit_button').addClass('active');
        });

        $('#image_edit_button').click(function () {

            $("#sideNav a[class*='active']").removeClass('active');
            $('#image_edit_button').addClass('active');

        });

        $('#compose_view_button').click(function () {

            $("#sideNav a[class*='active']").removeClass('active');
            $('#compose_view_button').addClass('active');
            $('#image_view').hide();
            $('#edit_view').hide();
            $('#image_manage_view').hide();
            $('#compose_view').show();


        });

        $('#image_manage_button').click(function () {
            $("#sideNav a[class*='active']").removeClass('active');
            $('#image_manage_button').addClass('active');
            $('#image_view').hide();
            $('#edit_view').hide();
            $('#compose_view').hide();
            $('#image_manage_view').show();

            loadImageManagement();
        });


        $('#fgqy_button').click(function () {
            $('#edit_view').hide();
            $('#compose_view').hide();
            $('#image_manage_view').hide();
            //the other views should be hide too
            $('#image_view').show();
        });


        $.extend($.FroalaEditor.POPUP_TEMPLATES, {
            'customPlugin.popup': '[_BUTTONS_]'
        });

        // Define popup buttons.
        $.extend($.FroalaEditor.DEFAULTS, {
            popupButtons: ['popupClose', '|', 'popupButton1', 'popupButton2', 'image_important', '|', 'generateImage'],
        });

        // The custom popup is defined inside a plugin (new or existing).
        $.FroalaEditor.PLUGINS.customPlugin = function (editor) {
            // Create custom popup.
            function initPopup() {
                // Load popup template.
                var template = $.FroalaEditor.POPUP_TEMPLATES.customPopup;
                if (typeof template == 'function') template = template.apply(editor);

                // Popup buttons.
                var popup_buttons = '';

                // Create the list of buttons.
                if (editor.opts.popupButtons.length > 1) {
                    popup_buttons += '<div class="fr-buttons">';
                    popup_buttons += editor.button.buildList(editor.opts.popupButtons);
                    popup_buttons += '</div>';
                }

                // Load popup template.
                var template = {
                    buttons: popup_buttons,
                    custom_layer: '<div class="custom-layer">为文本选择相应的类型</div>'
                };

                // Create popup.
                var $popup = editor.popups.create('customPlugin.popup', template);

                return $popup;
            }

            // Show the popup
            function showPopup() {
                // Get the popup object defined above.
                var $popup = editor.popups.get('customPlugin.popup');

                // If popup doesn't exist then create it.
                // To improve performance it is best to create the popup when it is first needed
                // and not when the editor is initialized.
                if (!$popup) $popup = initPopup();

                // Set the editor toolbar as the popup's container.
                editor.popups.setContainer('customPlugin.popup', editor.$tb);

                // If the editor is not displayed when a toolbar button is pressed, then set BODY as the popup's container.
                // editor.popups.setContainer('customPlugin.popup', $('body'));

                // Trigger refresh for the popup.
                // editor.popups.refresh('customPlugin.popup');

                // This custom popup is opened by pressing a button from the editor's toolbar.
                // Get the button's object in order to place the popup relative to it.
                var $btn = editor.$tb.find('.fr-command[data-cmd="myButton"]');

                // Compute the popup's position.
                var left = $btn.offset().left + $btn.outerWidth() / 2;
                var top = $btn.offset().top + (editor.opts.toolbarBottom ? 10 : $btn.outerHeight() - 10);

                // Show the custom popup.
                // The button's outerHeight is required in case the popup needs to be displayed above it.
                editor.popups.show('customPlugin.popup', left, top, $btn.outerHeight());
            }

            // Hide the custom popup.
            function hidePopup() {
                editor.popups.hide('customPlugin.popup');
            }

            // Methods visible outside the plugin.
            return {
                showPopup: showPopup,
                hidePopup: hidePopup
            }
        };

        // Define an icon and command for the button that opens the custom popup.
        $.FroalaEditor.DefineIcon('buttonIcon', {NAME: 'star'})
        $.FroalaEditor.RegisterCommand('myButton', {
            title: 'Show Popup',
            icon: 'buttonIcon',
            undo: false,
            focus: false,
            popup: true,
            // Buttons which are included in the editor toolbar should have the plugin property set.
            plugin: 'customPlugin',
            callback: function () {
                if (!this.popups.isVisible('customPlugin.popup')) {
                    this.customPlugin.showPopup();
                }
                else {
                    if (this.$el.find('.fr-marker')) {
                        this.events.disableBlur();
                        this.selection.restore();
                    }
                    this.popups.hide('customPlugin.popup');
                }
            }
        });

        // Define custom popup close button icon and command.
        $.FroalaEditor.DefineIcon('popupClose', {NAME: 'times'});
        $.FroalaEditor.RegisterCommand('popupClose', {
            title: 'Close',
            undo: false,
            focus: false,
            callback: function () {
                this.customPlugin.hidePopup();
            }
        });

        // Define custom popup 1.
        $.FroalaEditor.DefineIcon('popupButton1', {NAME: 'code'});
        $.FroalaEditor.RegisterCommand('popupButton1', {
            title: '代码段',
            undo: false,
            focus: false,
            callback: function () {
                var text = $('#edit').froalaEditor('selection.text');
                $('#edit').froalaEditor('html.insert', '<code>' + text + '</code>', true);
            }
        });

        // Define custom popup 2.
        $.FroalaEditor.DefineIcon('popupButton2', {NAME: 'info'});
        $.FroalaEditor.RegisterCommand('popupButton2', {
            title: '大标题',
            undo: false,
            focus: false,
            callback: function () {
                var text = $('#edit').froalaEditor('selection.text');
                $('#edit').froalaEditor('html.insert', '<h1>' + text + '</h1>', true);
            }
        });

        // Define image_important.
        $.FroalaEditor.DefineIcon('image_important', {NAME: 'info'});
        $.FroalaEditor.RegisterCommand('image_important', {
            title: '重要图片',
            undo: false,
            focus: false,
            callback: function () {
                var $img = this.image.get();
                $img.addClass('important');
            }
        });

        //相似图片推荐
        $.FroalaEditor.DefineIcon('image_recommendation', {NAME: 'info'});
        $.FroalaEditor.RegisterCommand('image_recommendation', {
            title: '相似图片推荐',
            undo: false,
            focus: false,
            callback: function () {
                var $img = this.image.get();
                var src = $img.attr('src');
                $('#img_rec').attr('src', src);
                func_1();
                $('#showModal').trigger('click');
            }
        });

        //圈字出图
        $.FroalaEditor.DefineIcon('generateImage', {NAME: 'star'});
        $.FroalaEditor.RegisterCommand('generateImage', {
            title: '圈字出图',
            undo: false,
            focus: false,
            callback: function () {
                var text = $('#edit').froalaEditor('selection.text');
                console.log(text);
                $.ajax({
                    url: "/generateImage",
                    method: 'get',
                    data: {
                        'str': text,
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);

                    },
                    error: function (xhr) {
                        console.log(xhr);
                        $.ajax({
                            url: '/image/saveAttn',
                            method: 'get',
                            data: 'a',
                            success: function (response) {
                                console.log(response);
                                $('#attn_img').attr('src', response);
                                $('#showAttn').trigger('click');
                            },
                            error: function (xhr) {
                                console.log(xhr);
                            }
                        });
                    }
                });

            }
        });

        $('#edit').froalaEditor({
            iframe: true,
            toolbarButtons: ['myButton', 'fullscreen', '|', 'bold', 'italic', 'underline', 'strikeThrough', 'fontFamily', 'paragraphFormat', 'formatOL', 'formatUL', 'quote', 'insertLink', 'insertImage', '|', 'insertHR', 'clearFormatting', 'html', 'wirisEditor', 'wirisChemistry'],
            // Add [MW] buttons to Image Toolbar.
            imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption', 'imageRemove', 'imageLink', 'imageDisplay', 'imageStyle', 'imageAlt', 'imageSize', 'imageTUI', 'image_important', 'image_recommendation'],
            //documentReady: true,
            height: 480,
            language: 'zh_cn',
            imageDefaultDisplay: 'inline',
            imageDefaultWidth: 700,
            imageUploadParam: 'image',
            imageUploadMethod: 'post',
            // Set the image upload URL.
            imageUploadURL: '/image',
            imageUploadParams: {
                locaton: 'froala', // This allows us to distinguish between Froala or a regular file upload.
                _token: "{{ csrf_token() }}" // This passes the laravel token with the ajax request.
            },
            // Set page size.
            imageManagerPageSize: 20,
            // Set a scroll offset (value in pixels).
            imageManagerScrollOffset: 10,
            // Set the load images request URL.
            imageManagerLoadURL: "/image/getImageList",
            // Set the load images request type.
            imageManagerLoadMethod: "GET",
            // Additional load params.
            imageManagerLoadParams: {user_id: "{{auth()->user()->id}}"},
            // Set the delete image request URL.
            imageManagerDeleteURL: "/image",
            // Set the delete image request type.
            imageManagerDeleteMethod: "DELETE",
            // Additional delete params.
            imageManagerDeleteParams: {
                _token: "{{ csrf_token() }}",
                loaction: "froala"
            },


            //save content
            saveParam: 'content',
            // Set the save URL.
            saveURL: '/article',
            // HTTP request type.
            saveMethod: 'POST',
            // Additional save params.
            saveParams: {}
        })
            .on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
                $.extend(editor.opts.imageManagerDeleteParams, {
                    src: $img.attr('src'),
                    _token: "{{ csrf_token() }}",
                    loaction: "froala"
                });
            })
            .on('froalaEditor.imageManager.imagesLoaded', function (e, editor, data) {
                // Do something when the request finishes with success.
                console.log('Images have been loaded.');
            })
            .on('froalaEditor.save.before', function (e, editor) {
                $.extend(editor.opts.saveParams, {
                    title: $("#title").val(),
                    _token: "{{ csrf_token() }}",
                    category: $("#category").val(),
                    shareStatus: $('#shareValue').val(),
                    uploadFlag: uploadFlag,
                    composeFlag: composeFlag,
                });

            })
            .on('froalaEditor.save.after', function (e, editor, response) {
                composeFlag = 0;

                setFormSubmitting();
                console.log(response);
                var article_id = response.article_id;
                lastUploadArticle = article_id;
                if (uploadFlag) {
                    var fd = new FormData();
                    fd.append('cover', $("#cover_file").get(0).files[0]);
                    fd.append('_token', "{{csrf_token()}}");
                    fd.append('article_id', article_id);
                    $.ajax({
                        method: "post",
                        url: "/cover_upload",
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                        }
                    });
                }
                uploadFlag = 0;
                if (response.status[0]) {
                    //alert("上传成功");
                }

                if (typeof response.plan !== 'undefined') {
                    for (let i = 0; i < response.plan.length; i++) {
                        $.ajax({
                            url: "/encrypt",
                            data: {
                                data: article_id,
                            },
                            method: "get",
                            success: function (data) {
                                var plan_id = i + 1;
                                $('#compose_plan').append('<a href="/compose_plan/' + data + '/' + plan_id + '" target="_blank"><img style="height: 282px; width: 200px; " src="/images/mode_' + plan_id + '.png" alt="plan' + response.plan[i] + '" class="img-thumbnail ml-3"></a>')
                            }
                        })

                    }
                }

                else {
                    if (typeof response.title !== 'undefined') {
                        for (let i = 0; i < response.title.length; i++) {
                            console.log(response.title[i]);
                        }
                    }
                    if (typeof response.category !== 'undefined') {
                        for (let i = 0; i < response.category.length; i++) {
                            console.log(response.category[i]);
                        }
                    }
                    if (typeof response.shareStatus !== 'undefined') {
                        for (let i = 0; i < response.shareStatus.length; i++) {
                            console.log(response.shareStatus[i]);
                        }
                    }
                    if (typeof response.msg !== 'undefined') {
                        for (let i = 0; i < response.msg.length; i++) {
                            console.log(response.msg[i]);
                        }
                    }

                }
            })
            .on('froalaEditor.save.error', function (e, editor, error) {
                console.log(error);
            })
            .on('froalaEditor.image.uploaded', function (e, editor, response) {
                console.log(response);
                console.log(response.substring(9, response.length - 2));
                $('#img').attr('src', response.substring(9, response.length - 2));
                func();
            });

        $(function () {
            $("#editor").addClass("active-item");
        });
        $("#send").click(function () {
            uploadFlag = 1;
            $('#edit').froalaEditor('save.save');
        });
        $('#privateStatus').click(function () {
            $('#shareStatus').html('私密发布');
            $('#shareValue').val(0);
        });
        $('#publicStatus').click(function () {
            $('#shareStatus').html('公开发布');
            $('#shareValue').val(1);
        });

        $('#compose').click(function () {
            $('#compose_plan').empty();
            composeFlag = 1;
            $('#progressDiv').show();
            pb = $('[role="progressbar"]')
            pb.css('transition', 'none'); // if not already done in your css
            pb.animate({
                width: "100%"
            }, {
                duration: 3 * 1000, // 5 seconds
                easing: 'linear',
                step: function (now, fx) {
                    var current_percent = Math.round(now);
                    pb.attr('aria-valuenow', current_percent);
                    pb.text(current_percent + '%');
                },
                complete: function () {
                    $('#progressDiv').hide();
                    pb.attr('style', 'width: 0%;');
                    $("#send").trigger('click');
                }
            });

        });

        // $('#cover_upload').click(function(){
        //     $('#cover').show();
        // });
    </script>

@endsection