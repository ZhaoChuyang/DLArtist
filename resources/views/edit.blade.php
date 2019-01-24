@extends('layouts.shop')

@section('head')
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.5.1//js/froala_editor.pkgd.min.js"></script>

    <!-- Initialize the editor. -->
    <script>
        $(function() {
            $('#edit').froalaEditor({
                height: 600
            })
        });
    </script>

@endsection

@section('content')

    <div id="home-wrap" class="content-section">
        <div class="container">
            <!-- Shortcodes -->
            <div class="row no-margin">
                <!--  Grid Images with Lightbox  -->
                <div class="project-images grid text">
                    <div class="col-md-9">
                        <form>
                            <textarea id="edit" name="content"></textarea>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection