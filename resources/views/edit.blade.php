@extends('layouts.shop')
@section('head')
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <!-- Include Editor style. -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row no-margin wrap-text padding-onlytop-lg">
        <div class="col-md-10 col-md-offset-1 padding-leftright-null">
            <div class="text small padding-topbottom-null">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-one" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true"><strong>撰写文章</strong></a></li>
                    <li role="presentation" class=""><a href="#tab-two" aria-controls="tab-two" role="tab" data-toggle="tab" aria-expanded="false"><strong>精美配图</strong></a></li>
                </ul>
                <div class="tab-content no-margin-bottom">
                    {{--//编辑--}}
                    <div role="tabpanel" class="tab-pane padding-md active" id="tab-one">
                           <form>
                                <textarea id="edit" name="content"></textarea>
                            </form>
                            <br>
                            <button type="button" class="btn btn-info " id="send">发表文章</button>
                            <button type="button" class="btn btn-warning col-md-offset-0" id=" compose">自动排版</button>
                    </div>
                    {{--//画图--}}
                    <div role="tabpanel" class="tab-pane padding-md" id="tab-two">
                    </div>
                </div>
            </div>
        </div>
    </div>








@endsection

@section('script')
    <!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>
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


    <!-- Initialize the editor. -->
    <script>
        $(function() {
            $('#edit').froalaEditor({
                height: 480,
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
                imageManagerDeleteURL: "/",
                // Set the delete image request type.
                imageManagerDeleteMethod: "DELETE",
                imageManagerDeleteParams: {
                    _token: "{{ csrf_token() }}"
                }
            })

        });
        $(function () {
            $("#editor").addClass("active-item");
        });
        $("#send").click(function () {
            var use_id =  '{{ Auth::id() }}';   //user_id
            var array = new Array();
            var article = $("#edit").val();
            array = article.split('><');
            var title = array[0];                       //title
            var content = '<';
            for(var i=1;i<array.length;i++){
                if (i<array.length-1)
                    content+=array[i]+'><';
                else
                    content+=array[i];                  //content
            }
            $.ajax({

            });
        });
    </script>

@endsection