@extends('layouts.edit')

@section('head')
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css">
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

    <!--JQuery Modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>

@endsection

@section('content')

    <style>
        html {
            box-sizing: border-box;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .hero-grid {
            position: relative;
            float: left;
            overflow: hidden;
            background: #3085a3;
            cursor: pointer;
            margin: -5px;
            max-width: 400px;
            max-height: 300px;
        }

        .hero-grid-image {
            position: relative;
            display: block;
            min-height: 100%;
            max-width: 100%;
            opacity: 0.2;
        }

        .hero-grid-content {
            padding: 2em;
            color: #fff;
            text-transform: uppercase;
            font-size: 1.25em;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .hero-grid-content::before,
        .hero-grid-content::after {
            pointer-events: none;
        }

        .hero-grid-link {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            text-indent: 200%;
            white-space: nowrap;
            font-size: 0;
            opacity: 0;
        }

        .hero-grid-title {
            letter-spacing: -1px;
            font-weight: 300;
            margin: 0;
            padding: 0.25em 0;
            line-height: 1;
        }

        .hero-grid-title span {
            font-weight: 800;
        }

        .hero-tag {
            display: inline-block;
            font-size: .5em;
            padding: .5em;
            background: #fff;
            color: #000;
        }

        .hero-grid h2,
        .hero-grid p {
            margin: 0;
        }

        .hero-grid p {
            letter-spacing: 1px;
            font-size: 68.5%;
            height: 2.25em;
            overflow: hidden;
        }

        .effect-image {
            max-width: none;
            width: -webkit-calc(100% + 50px);
            width: calc(100% + 50px);
            opacity: 0.2;
            -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
            transition: opacity 0.35s, transform 0.35s;
            -webkit-transform: translate3d(-40px, 0, 0);
            transform: translate3d(-40px, 0, 0);
        }

        .effect-target {
            -webkit-transform: translate3d(0, 40px, 0);
            transform: translate3d(0, 40px, 0);
        }

        .effect-target {
            -webkit-transition: -webkit-transform 0.35s;
            transition: transform 0.35s;
        }

        .effect-text {
            color: rgba(255, 255, 255, 0.8);
            opacity: 0;
            -webkit-transition: opacity 0.2s, -webkit-transform 0.35s;
            transition: opacity 0.2s, transform 0.35s;
        }

        .effect-move:hover .effect-image,
        .effect-move:hover .effect-text {
            opacity: 1;
        }

        .effect-move:hover .effect-target,
        .effect-move:hover .effect-image {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .effect-move:hover .effect-text {
            -webkit-transition-delay: 0.05s;
            transition-delay: 0.05s;
            -webkit-transition-duration: 0.35s;
            transition-duration: 0.35s;
        }

    </style>
    <!--弹出的modal部分-->
    <div class="container" id="modal_next" style="display:none">
        <style>


            h1, h2, h3, h4, h5, h6 {
                font-weight: 200;
            }

            a {
                text-decoration: none;
            }

            p, li, a {
                font-size: 14px;
            }

            fieldset {
                margin: 0;
                padding: 0;
                border: none;
            }

            /* GRID */

            .twelve {
                width: 100%;
            }

            .eleven {
                width: 91.53%;
            }

            .ten {
                width: 83.06%;
            }

            .nine {
                width: 74.6%;
            }

            .eight {
                width: 66.13%;
            }

            .seven {
                width: 57.66%;
            }

            .six {
                width: 49.2%;
            }

            .five {
                width: 40.73%;
            }

            .four {
                width: 32.26%;
            }

            .three {
                width: 23.8%;
            }

            .two {
                width: 15.33%;
            }

            .one {
                width: 6.866%;
            }

            /* COLUMNS */

            .st_col {
                display: block;
                float: left;
                margin: 0 0 0 1.6%;
            }

            .st_col:first-of-type {
                margin-left: 0;
            }

            .st_container {
                width: 100%;
                max-width: 700px;
                margin: 0 auto;
                position: relative;
            }

            .st_row {
                padding: 20px 0;
            }

            /* CLEARFIX */

            .cf:before,
            .cf:after {
                content: " ";
                display: table;
            }

            .cf:after {
                clear: both;
            }

            .cf {
                *zoom: 1;
            }

            .wrapper {
                width: 100%;
                margin: 30px 0;
            }

            /* STEPS */

            .steps {
                list-style-type: none;
                margin: 0;
                padding: 0;
                background-color: #fff;
                text-align: center;
            }

            .steps li {
                display: inline-block;
                margin: 20px;
                color: #ccc;
                padding-bottom: 5px;
            }

            .steps li.is-active {
                border-bottom: 1px solid #3498db;
                color: #3498db;
            }

            /* FORM */

            .form-wrapper .section {
                padding: 0px 20px 30px 20px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                background-color: #fff;
                opacity: 0;
                -webkit-transform: scale(1, 0);
                -ms-transform: scale(1, 0);
                -o-transform: scale(1, 0);
                transform: scale(1, 0);
                -webkit-transform-origin: top center;
                -moz-transform-origin: top center;
                -ms-transform-origin: top center;
                -o-transform-origin: top center;
                transform-origin: top center;
                -webkit-transition: all 0.5s ease-in-out;
                -o-transition: all 0.5s ease-in-out;
                transition: all 0.5s ease-in-out;
                text-align: center;
                position: absolute;
                width: 100%;
                min-height: 300px
            }

            .form-wrapper .section h3 {
                margin-bottom: 30px;
            }

            .form-wrapper .section.is-active {
                opacity: 1;
                -webkit-transform: scale(1, 1);
                -ms-transform: scale(1, 1);
                -o-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            .form-wrapper .button, .form-wrapper .submit {
                background-color: #3498db;
                display: inline-block;
                padding: 8px 30px;
                color: #fff;
                cursor: pointer;
                font-size: 14px !important;
                font-family: 'Open Sans', sans-serif !important;
                position: absolute;
                right: 20px;
                bottom: 20px;
            }

            .form-wrapper .submit {
                border: none;
                outline: none;
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

            .form-wrapper input[type="text"],
            .form-wrapper input[type="password"] {
                display: block;
                padding: 10px;
                margin: 10px auto;
                background-color: #f1f1f1;
                border: none;
                width: 100%;
                outline: none;
                font-size: 14px !important;
                font-family: 'Open Sans', sans-serif !important;
            }

            .form-wrapper input[type="radio"] {
                display: none;
            }

            .form-wrapper input[type="radio"] + label {
                display: block;
                border: 1px solid #ccc;
                width: 100%;
                max-width: 100%;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                cursor: pointer;
                position: relative;
            }

            .form-wrapper input[type="radio"] + label:before {
                content: "✔";
                position: absolute;
                right: -10px;
                top: -10px;
                width: 30px;
                height: 30px;
                line-height: 30px;
                border-radius: 100%;
                background-color: #3498db;
                color: #fff;
                display: none;
            }

            .form-wrapper input[type="radio"]:checked + label:before {
                display: block;
            }

            .form-wrapper input[type="radio"] + label h4 {
                margin: 15px;
                color: #ccc;
            }

            .form-wrapper input[type="radio"]:checked + label {
                border: 1px solid #3498db;
            }

            .form-wrapper input[type="radio"]:checked + label h4 {
                color: #3498db;
            }

        </style>
        <div class="st_container" style="height: 375px; padding-left: 0px;">
            <div class="wrapper" style="margin-left: 0px;">
                <ul class="steps">
                    <li class="is-active">Step 1</li>
                    <li>Step 2</li>
                    <li>Step 3</li>
                </ul>
                <form class="form-wrapper">
                    <fieldset class="section is-active">
                        <h3>摘要生成</h3>
                        <textarea id="summary_text" style="height: 125px;" class="form-control mb-3"></textarea>
                        <!--是否需要生成摘要-->
                        <div style="position: absolute; right: 20px;">
                            <input class="form-check-input" type="checkbox" value="" id="need_summary">
                            <label class="form-check-label" for="need_summary">
                                需要摘要
                            </label>
                        </div>
                        <div class="button">Next</div>
                    </fieldset>

                    <fieldset class="section">
                        <h3>选择封面</h3>
                        <figure class="hero-grid effect-move" onclick="getCoverPath()">
                            <img class="hero-grid-image effect-image" style="width: 400px; height: 150px;"
                                 src="https://cdn.dribbble.com/users/329207/screenshots/4836512/bemocs_wsj_01.jpg"
                                 alt="" id="cover_preview"/>
                            <figcaption class="hero-grid-content">
                                {{--<span class="hero-tag effect-target">Category</span>--}}
                                <h2 class="hero-grid-title effect-target">Cover Image</h2>
                                <p class="hero-grid-text effect-target effect-text">CHOOSE YOUR COVER</p>

                            </figcaption>
                        </figure>
                        {{--<img src="storage/avatar/default_avatar.jpg" class="img_hover" style="width: 400px; height: 150px;" id="cover_img" onclick="getCoverPath()">--}}
                        <input type="file" id="cover_file" name="cover_file" style="visibility:hidden; display:none;">
                        <div class="button">Next</div>
                    </fieldset>
                    <fieldset class="section">
                        <h3>文章属性</h3>
                        <!--文章是否共享-->
                        <div class="row cf">
                            <div class="two col" id="shareDiv">
                                <input type="radio" name="r1" id="r1" value="1" checked>
                                <label for="r1">
                                    <h4>共享</h4>
                                </label>
                            </div>
                            <div class="two col">
                                <input type="radio" name="r1" id="r2" value="0">
                                <label for="r2">
                                    <h4>私密</h4>
                                </label>
                            </div>
                        </div>

                        <select class="custom-select mt-4" id="category">
                            <option value="0" selected>选择文章类型</option>
                            <option value="1">文娱</option>
                            <option value="2">科教</option>
                            <option value="3">军事</option>
                        </select>
                        <input id="savePassage" class="submit button" type="submit" value="Finish">
                    </fieldset>
                    <fieldset class="section">
                        <h3>Account Created!</h3>
                        <p>Your account has now been created.</p>
                        <a class="button" rel="modal:close" style="color: white;">Close</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!--modal部分结束-->


    <!--编辑器部分-->
    <section class="fdb-block" style="background-image: url(svg/blue.svg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-7 col-xl-9 text-center">
                    <div class="fdb-box">
                        <div class="row">

                            <div class="col">
                                <h1>Hape Editor</h1>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <style>
                                    .group_m {
                                        position: relative;
                                        margin-bottom: 10px;
                                    }

                                    .mds_input {
                                        font-size: 18px;
                                        padding: 10px 10px 10px 5px;
                                        display: block;
                                        width: 100%;
                                        border: none;
                                        border-bottom: 1px solid #757575;
                                    }

                                    .mds_input:focus {
                                        outline: none;
                                    }

                                    .mds_label {
                                        color: #999;
                                        font-size: 18px;
                                        font-weight: normal;
                                        position: absolute;
                                        pointer-events: none;
                                        left: 5px;
                                        top: 10px;
                                        transition: 0.2s ease all;
                                        -moz-transition: 0.2s ease all;
                                        -webkit-transition: 0.2s ease all;
                                    }

                                    /* active state */
                                    .mds_input:focus ~ .mds_label, .mds_input:valid ~ .mds_label {
                                        top: -20px;
                                        font-size: 14px;
                                        color: #5264AE;
                                    }

                                    /* BOTTOM BARS ================================= */
                                    .bar {
                                        position: relative;
                                        display: block;
                                        width: 100%;
                                    }

                                    .bar:before, .bar:after {
                                        content: '';
                                        height: 2px;
                                        width: 0;
                                        bottom: 1px;
                                        position: absolute;
                                        background: #5264AE;
                                        transition: 0.2s ease all;
                                        -moz-transition: 0.2s ease all;
                                        -webkit-transition: 0.2s ease all;
                                    }

                                    .bar:before {
                                        left: 50%;
                                    }

                                    .bar:after {
                                        right: 50%;
                                    }

                                    /* active state */
                                    .mds_input:focus ~ .bar:before, .mds_input:focus ~ .bar:after {
                                        width: 50%;
                                    }

                                    /* HIGHLIGHTER ================================== */
                                    .highlight {
                                        position: absolute;
                                        height: 60%;
                                        width: 100px;
                                        top: 25%;
                                        left: 0;
                                        pointer-events: none;
                                        opacity: 0.5;
                                    }

                                    /* active state */
                                    .mds_input:focus ~ .highlight {
                                        -webkit-animation: inputHighlighter 0.3s ease;
                                        -moz-animation: inputHighlighter 0.3s ease;
                                        animation: inputHighlighter 0.3s ease;
                                    }

                                    /* ANIMATIONS ================ */
                                    @-webkit-keyframes inputHighlighter {
                                        from {
                                            background: #5264AE;
                                        }
                                        to {
                                            width: 0;
                                            background: transparent;
                                        }
                                    }

                                    @-moz-keyframes inputHighlighter {
                                        from {
                                            background: #5264AE;
                                        }
                                        to {
                                            width: 0;
                                            background: transparent;
                                        }
                                    }

                                    @keyframes inputHighlighter {
                                        from {
                                            background: #5264AE;
                                        }
                                        to {
                                            width: 0;
                                            background: transparent;
                                        }
                                    }
                                </style>
                                <div class="group_m">
                                    <input type="text" id="title" required class="mds_input">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="mds_label">Title</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <textarea id="edit" name="content"></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary" id="next">Next</button>
                                <!-- Link to open the modal -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--编辑器部分结束-->

@endsection

@section('script')
    <!--froala's js file-->
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/froala_editor.min.js"></script>
    <!--forla's plugin-->
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/quote.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/save.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="froala_editor_2.9.1/js/languages/zh_cn.js"></script>

    <!--external js file-->
    <!-- Include external JS libs. -->
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>--}}
    {{--<script type="text/javascript"--}}
    {{--src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>--}}
    {{--<script type="text/javascript"--}}
    {{--src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>--}}
    {{----}}


    <script>

        /*****全局变量*****/

        //文章id
        var article_id = 0;
        //是否共享
        var shared = 0;
        //是否上传封面
        var uploadCover=0;
        /*****************/

        //加载进该页面时的初始化工作
        $(document).ready(function () {
            $.ajax({
                type: "post",
                url: "/article/getId",
                data: {
                    "_token": '{{csrf_token()}}',
                },
                success: function (response) {
                    article_id = response;
                    console.log(response);
                },
                error: function (xhr) {
                    //window.location.replace("/abort/404");//重定向去错误页
                    console.log(xhr);
                }

            });
        });

        //当选择封面之后，就取出封面的src，以便浏览更换后的封面
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cover_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        //更换封面点击事件
        $("#cover_file").change(function () {
            readURL(this);
            uploadCover=1;
        });

        //隐藏文件输入框之后，获取封面图片的地址
        function getCoverPath() {
            document.getElementById('cover_file').click();
        }


        //next按钮点击事件，弹出modal窗口给用户进一步选择
        $('#next').click(function () {
            $("#modal_next").modal({
                //去除关闭按钮
                showClose: false,
                //fade效果
                fadeDuration: 300

            });
        });

        //保存文章
        $('#savePassage').click(function () {
            $('#edit').froalaEditor('save.save');
        });

        //NextModal的js部分
        $(document).ready(function () {
            $(".form-wrapper .button").click(function () {
                var button = $(this);
                var currentSection = button.parents(".section");
                var currentSectionIndex = currentSection.index();
                var headerSection = $('.steps li').eq(currentSectionIndex);
                currentSection.removeClass("is-active").next().addClass("is-active");
                headerSection.removeClass("is-active").next().addClass("is-active");

                $(".form-wrapper").submit(function (e) {
                    e.preventDefault();
                });

                if (currentSectionIndex === 3) {
                    $(document).find(".form-wrapper .section").first().addClass("is-active");
                    $(document).find(".steps li").first().addClass("is-active");
                }
            });
        });


        //编辑器的js部分
        $('#edit').froalaEditor({
            iframe: true,
            toolbarButtons: ['myButton', 'fullscreen', '|', 'bold', 'italic', 'underline', 'strikeThrough', 'fontFamily', 'paragraphFormat', 'formatOL', 'formatUL', 'quote', 'insertLink', 'insertImage', '|', 'insertHR', 'clearFormatting', 'html', 'wirisEditor', 'wirisChemistry'],

            imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption', 'imageRemove', 'imageLink', 'imageDisplay', 'imageStyle', 'imageAlt', 'imageSize', 'imageTUI', 'image_important', 'image_recommendation'],
            //documentReady: true,
            height: 600,
            language: 'zh_cn',
            imageDefaultDisplay: 'inline',

            imageDefaultWidth: 300,

            //图片上传的参数
            imageUploadParam: 'image',
            imageUploadMethod: 'post',
            //图片上传地址
            imageUploadURL: '/image',
            imageUploadParams: {
                _token: "{{ csrf_token() }}", // This passes the laravel token with the ajax request.
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

            //设置大于0时会自动保存
            saveInterval: 0,
            //content的key
            saveParam: 'content',
            //保存的路由地址
            saveURL: '/article',
            saveMethod: 'POST',
            //额外的参数
            saveParams: {}
        })
            .on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
                $.extend(editor.opts.imageManagerDeleteParams, {
                    src: $img.attr('src'),
                    _token: "{{ csrf_token() }}",
                    loaction: "froala"
                });
            })
            //当图库加载完成
            .on('froalaEditor.imageManager.imagesLoaded', function (e, editor, data) {
                console.log('Images have been loaded.');
                //console.log(data);
            })
            //保存文章前的准备工作
            .on('froalaEditor.save.before', function (e, editor) {
                //获取文章权限
                shared=$('input[name=r1]:checked', '#shareDiv').val();

                var cover_url;

                //是否需要上传封面
                if(uploadCover){
                    //新建封面文件对象
                    var fd=new FormData();

                    fd.append('cover', $('#cover_file').get(0).files[0]);
                    fd.append('_token', "{{csrf_token()}}");
                    fd.append('article_id', article_id);

                    $.ajax({
                        method: "post",
                        url: "/cover_upload",
                        data: fd,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function (response) {
                            console.log(response);

                            //取得封面地址
                            cover_url=response;

                        }
                    });
                }
                else
                    cover_url="https://cdn.dribbble.com/users/329207/screenshots/4836512/bemocs_wsj_01.jpg";

                //添加文章一些其他属性
                $.extend(editor.opts.saveParams, {
                    article_id: article_id,
                    title: $("#title").val(),
                    _token: "{{ csrf_token() }}",
                    category: $("#category").val(),
                    cover_url: cover_url,
                    shareStatus: shared,

                });

                console.log("准备保存文章");

            })
            //文章保存完成后的工作
            .on('froalaEditor.save.after', function (e, editor, response) {

                //setFormSubmitting();
                console.log(response);
                //var article_id = response.article_id;
                {{--lastUploadArticle = article_id;--}}
                {{--if (uploadFlag) {--}}
                    {{--var fd = new FormData();--}}
                    {{--fd.append('cover', $("#cover_file").get(0).files[0]);--}}
                    {{--fd.append('_token', "{{csrf_token()}}");--}}
                    {{--fd.append('article_id', article_id);--}}
                    {{--$.ajax({--}}
                        {{--method: "post",--}}
                        {{--url: "/cover_upload",--}}
                        {{--data: fd,--}}
                        {{--contentType: false,--}}
                        {{--processData: false,--}}
                        {{--success: function (response) {--}}
                            {{--console.log(response);--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}
                {{--uploadFlag = 0;--}}
                if (response.status[0]) {
                    //alert("上传成功");
                }

                // if (typeof response.plan !== 'undefined') {
                //     for (let i = 0; i < response.plan.length; i++) {
                //         $.ajax({
                //             url: "/encrypt",
                //             data: {
                //                 data: article_id,
                //             },
                //             method: "get",
                //             success: function (data) {
                //                 var plan_id = i + 1;
                //                 $('#compose_plan').append('<a href="/compose_plan/' + data + '/' + plan_id + '" target="_blank"><img style="height: 282px; width: 200px; " src="/images/mode_' + plan_id + '.png" alt="plan' + response.plan[i] + '" class="img-thumbnail ml-3"></a>')
                //             }
                //         })
                //
                //     }
                // }

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
            //文章保存出错时
            .on('froalaEditor.save.error', function (e, editor, error) {
                console.log(error);
            })
            //图片上传完成时
            .on('froalaEditor.image.uploaded', function (e, editor, response) {
                console.log(response);

                //console.log(response.substring(9, response.length - 2));
                //$('#img').attr('src', response.substring(9, response.length - 2));
                //func();
            })
            //图片上传出现错误时
            .on('froalaEditor.image.error', function (e, editor, error, response) {
                //console.log(response);
                console.log(article_id);
            })
            //在图片保存前添加保存参数-文章id，保证文章id是查询后的正确id
            .on('froalaEditor.image.beforeUpload', function (e, editor, images){
                $.extend(editor.opts.imageUploadParams, {
                    article_id: article_id,
                });
            })
        ;

    </script>

@endsection
