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

    <div class="container-fluid" >
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar mt-2" >
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
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-activity">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                图片美化
                            </a>
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
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#submenu-1" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-plus-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg>
                                下拉菜单
                            </a>
                            <ul id="submenu-1" class="collapse">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Current month
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Current month
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2 ml-4">Edit</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button class="btn btn-sm btn-outline-secondary">Share</button>
                            <button class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            This week
                        </button>
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
                        </div>
                    </div>
                </form>

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

    <script>
        $(document).ready(function(){
            $('#editMenu').addClass('active');
        });
    </script>

    <!-- Initialize the editor. -->
    <script>
        $(function () {
            // $.FroalaEditor.RegisterCommand('imageRemove', {
            //     title: '删除',
            //     focus: false,
            //     undo: false,
            //     refreshAfterCallback: false,
            //     callback: function () {
            //         var $img = this.image.get();
            //         alert("a");
            //     }
            // });


            $('#edit').froalaEditor({
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
                // URL to get all department images from
                imageManagerLoadURL: '/',
                // Set the delete image request URL.
                {{--imageManagerDeleteURL: "/image",--}}
                {{--// Set the delete image request type.--}}
                {{--imageManagerDeleteMethod: "DELETE",--}}
                {{--imageManagerDeleteParams: {--}}
                {{--_token: "{{ csrf_token() }}"--}}
                {{--},--}}
                //save content
                saveParam: 'content',
                // Set the save URL.
                saveURL: '/article',
                // HTTP request type.
                saveMethod: 'POST',
                // Additional save params.
                saveParams: {
                    _token: "{{ csrf_token() }}",
                    category: $("#category").val()
                }
            })
                .on('froalaEditor.save.before', function (e, editor) {
                    $.extend(editor.opts.saveParams, {
                        title: $("#title").val(),
                        _token: "{{ csrf_token() }}",
                        category: $("#category").val()
                    });
                })
                .on('froalaEditor.save.after', function (e, editor, response) {//return 1 if success
                    if (response == 1) {
                        alert('发表成功');
                    }
                    // else{
                    //     console.log(response);
                    // }
                })
                .on('froalaEditor.save.error', function (e, editor, error) {
                    console.log(error);
                })
                .on('froalaEditor.image.removed', function (e, editor, $img) {
                    $.ajax({
                        // Request method.
                        method: "DELETE",

                        // Request URL.
                        url: "/image",

                        // Request params.
                        data: {
                            src: $img.attr('src'),
                            _token: "{{ csrf_token() }}",
                            loaction: "froala"
                        }
                    })
                        .done(function (data) {
                            console.log(data);
                        })
                        .fail(function (data) {
                            console.log(data);
                        })
                })
                .on('froalaEditor.image.uploaded', function (e, editor, response) {
                    console.log(response);
                })
        });
        $(function () {
            $("#editor").addClass("active-item");
        });
        $("#send").click(function () {
            // alert($("#title").val());
            // 标题为纯文本
            $('#edit').froalaEditor('save.save');
            {{--var use_id = '{{ Auth::id() }}';   //user_id--}}
            {{--var array = [];--}}
            {{--var article = $("#edit").val();--}}
            {{--array = article.split('><');--}}
            {{--var title = array[0];                       //title--}}
            {{--var content = '<';--}}
            {{--for (var i = 1; i < array.length; i++) {--}}
            {{--if (i < array.length - 1)--}}
            {{--content += array[i] + '><';--}}
            {{--else--}}
            {{--content += array[i];                  //content--}}
            {{--}--}}
            {{--var category = $('#category').val();--}}
            {{--var data;--}}
            {{--data["title"] = title;--}}
            {{--data["content"] = content;--}}
            {{--data["category"] = category;--}}
            {{--data["_token"] = "{{csrf_token()}}";--}}
            {{--console.log(data);--}}
            {{--$.ajax({--}}
            {{--type: 'post',--}}
            {{--url: '/article',--}}
            {{--data: data,--}}
            {{--success: function (data) {--}}
            {{--alert("a");--}}
            {{--}--}}
            {{--});--}}
        });
    </script>

@endsection