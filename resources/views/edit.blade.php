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
        <div class="col-md-15 col-md-offset-1 padding-leftright-null">
            <div class="text small padding-topbottom-null">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-one" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true"><strong>撰写文章</strong></a></li>
                    <li role="presentation" class=""><a href="#tab-two" aria-controls="tab-two" role="tab" data-toggle="tab" aria-expanded="false"><strong>精美配图</strong></a></li>
                </ul>
                <div class="tab-content no-margin-bottom">
                    {{--//编辑--}}
                    <div role="tabpanel" class="tab-pane padding-md active" id="tab-one">
                            <div id="home-wrap" class="content-section">
                                <div class="container">
                                    <div class="row no-margin">
                                        <div class="project-images grid text">
                                            <div class="col-md-10">
                                                <form>
                                                    <textarea id="edit" name="content"></textarea>
                                                </form>
                                                <br>
                                                <button type="button" class="btn btn-info " id="send">发表文章</button>
                                                <button type="button" class="btn btn-warning col-md-offset-0" id=" compose">自动排版</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/languages/zh_cn.js"></script>
    <!-- Initialize the editor. -->
    <script>
        $(function() {
            $('#edit').froalaEditor({
                height: 480,
                imageDefaultDisplay: 'inline',
                language: 'zh_cn',
                charCounterMax: 3000,
            });
        });
        $(function () {
            $("#editor").addClass("active-item");
        });
        $("#send").click(function () {
            var use_id =  '{{ Auth::user()->name }}';   //user_id
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