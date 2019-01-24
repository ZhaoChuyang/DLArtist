@extends('layouts.shop')

@section('head')<!--编辑器的css-->
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')<!--编辑器的javascript-->

    <!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.5.1//js/froala_editor.pkgd.min.js"></script>

    <!--导出成pdf-->
    <script type="text/javascript" src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <!-- Initialize the editor. -->
    <script>
        $(function() {
            $('#edit').froalaEditor({

                //调整高度
                height: 600,
                // Set the file upload URL.
                fileUploadURL: '/upload_file.php',

                fileUploadParams: {
                    id: 'my_editor'
                }
            })
        });
    </script>

@endsection

@section('content')

        <div id="home-wrap" class="content-section">
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-10 padding-leftright-null">
                        <div class="text">
                            <textarea class="form-control" id="edit" style="height:1000px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection