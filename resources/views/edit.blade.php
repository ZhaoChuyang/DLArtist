@extends('layouts.edit')
@section('head')
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <!-- Include Editor style. -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet"
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
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-activity">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                排版方案
                            </a>
                        </li>
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="#" id="image_edit_button">--}}
                                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                                     {{--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                     {{--stroke-linejoin="round" class="feather feather-activity">--}}
                                    {{--<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>--}}
                                    {{--<circle cx="8.5" cy="8.5" r="1.5"></circle>--}}
                                    {{--<polyline points="21 15 16 10 5 21"></polyline>--}}
                                {{--</svg>--}}
                                {{--图片美化--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li class="nav-item">
                            <a href="#" data-toggle="collapse" data-target="#submenu-1" class="nav-link" id="image_edit_button">
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
                                    <a class="nav-link" href="#">
                                        文字生图
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="fgqy_button">
                                        风格迁移
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Current month
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
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
                                <label class="btn btn-outline-secondary btn-sm" id="cover_upload">
                                    更换封面<input id="cover_file" name="avatar" type="file" hidden>
                                </label>
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
                                <input type="text" class="form-control w-50" id="title" placeholder="请输入标题">
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
                                <button type="button" class="btn btn-success ml-2" id=" compose">自动排版
                                </button>
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
                            <li class="ml-5"><a href="#step-1" class="">Step 1<br /><small>上传图片</small></a></li>
                            <li class="ml-5"><a href="#step-2" class="">Step 2<br /><small>选择风格</small></a></li>
                            <li class="ml-5"><a href="#step-3" class="">Step 3<br /><small>生成图片</small></a></li>
                        </ul>

                        <div class="mt-4">
                            <div id="step-1" class="ml-3">
                                <h3 class="border-bottom border-gray pb-2">Step 1 上传图片</h3>
                                <form id="form1" runat="server">
                                    <label class="btn btn-outline-secondary btn-sm" id="cover_upload">
                                        上传图片<input id="imgInp" name="avatar" type="file" hidden>
                                    </label>
                                    <br>
                                    <img id="content" src="#" alt="your image" class="border p-2 rounded collapse" style="max-width: 300px; max-height: 300px;"/>
                                </form>
                            </div>
                            <div id="step-2" class="ml-3">
                                <h3 class="border-bottom border-gray pb-2">Step 2 选择风格</h3>
                                <form id="form1" runat="server">
                                    <label class="btn btn-outline-secondary btn-sm" id="cover_upload">
                                        上传图片<input id="imgInp2" name="avatar" type="file" hidden>
                                    </label>
                                    <br>
                                    <img id="style" src="#" alt="your image" class="border p-2 rounded collapse" style="max-width: 300px; max-height: 300px;"/>
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
                                <canvas id="stylized" width="192" height="256" class="image mt-2 border p-2 rounded"></canvas>
                                <br>
                            </div>
                        </div>


                    </div>

                </div>

            </main>
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

    <script>

        //风格迁移图片预览
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#content').attr('src', e.target.result);
                    $('#content_copy').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
            $('#content').show();
        });

        function readURL2(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#style').attr('src', e.target.result);
                    $('#style_copy').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp2").change(function() {
            readURL2(this);
            $('#style').show();
        });

        $(document).ready(function () {
            $('#editMenu').addClass('active');
            $('#image_view').hide();
            $('#smartwizard').smartWizard({
                selected: 0,  // Initial selected step, 0 = first step
                keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                autoAdjustHeight:true, // Automatically adjust content height
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
        });


    </script>

    <!-- Initialize the editor. -->
    <script>
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
            //the other views should be hide too
            $('#edit_view').show();

            $("#sideNav a[class*='active']").removeClass('active');
            $('#edit_button').addClass('active');
        });
        
        $('#image_edit_button').click(function () {


            $("#sideNav a[class*='active']").removeClass('active');
            $('#image_edit_button').addClass('active');

        });

        $('#fgqy_button').click(function () {
            $('#edit_view').hide();
            //the other views should be hide too
            $('#image_view').show();
        });

        $(function () {
            $('#edit').froalaEditor({
                iframe: true,
                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineClass', 'inlineStyle', 'paragraphStyle', 'lineHeight', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertImage', 'insertVideo', 'embedly', 'insertFile', 'insertTable', '|', 'emoticons', 'fontAwesome', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'getPDF', 'spellChecker', 'help', 'html', '|', 'undo', 'redo', '|', 'wirisEditor', 'wirisChemistry', 'clear', 'insert'],
                // Add [MW] buttons to Image Toolbar.
                // imageEditButtons: ['wirisEditor', 'wirisChemistry', 'imageDisplay', 'imageAlign', 'imageInfo', 'imageRemove'],
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

                // Set a preloader.
                imageManagerPreloader: "/images/loader.gif",
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
                        shareStatus: $('#shareValue').val()
                    });

                })
                .on('froalaEditor.save.after', function (e, editor, response) {//return 1 if success
                    setFormSubmitting();
                    console.log(response);

                    if (true) {
                        var article_id = response.article_id;
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

                    if (response.status[0]) {
                        alert("上传成功");
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
                {{--.on('froalaEditor.image.removed', function (e, editor, $img) {--}}
                {{--$.ajax({--}}
                {{--// Request method.--}}
                {{--method: "DELETE",--}}

                {{--// Request URL.--}}
                {{--url: "/image",--}}

                {{--// Request params.--}}
                {{--data: {--}}
                {{--src: $img.attr('src'),--}}
                {{--_token: "{{ csrf_token() }}",--}}
                {{--loaction: "froala"--}}
                {{--}--}}
                {{--})--}}
                {{--.done(function (data) {--}}
                {{--console.log(data);--}}
                {{--})--}}
                {{--.fail(function (data) {--}}
                {{--console.log(data);--}}
                {{--})--}}
                {{--})--}}
                .on('froalaEditor.image.uploaded', function (e, editor, response) {
                    console.log(response);
                })
        });
        $(function () {
            $("#editor").addClass("active-item");
        });
        $("#send").click(function () {
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
        // $('#cover_upload').click(function(){
        //     $('#cover').show();
        // });
    </script>

@endsection