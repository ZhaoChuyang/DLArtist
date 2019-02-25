<!DOCTYPE HTML>
<html>

<script src=model_js/test3_js/jquery.js></script>
<script src=model_js/test3_js/underscore.js></script>
<script src=model_js/test3_js/smartcrop.js></script>
<script src=model_js/test3_js/smartcrop-debug.js></script>
<script src=model_js/test3_js/tracking-min.js></script>
<script src=model_js/test3_js/tracking-face-min.js></script>
<script src=model_js/test3_js/jquery.facedetection.min.js></script>
<script src=model_js/test3_js/testbed.js></script>
<head>
    <meta charset="utf-8">
    <title>smartcrop.js testbed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<input type="file" id="file" accept="image/*" onchange="previewHandle(this)" />
<img id="preview-img" />
<input type="text" id="width" value="100" hidden>
<input type="text" id="height" value="100" hidden>
<script>

    function previewHandle(fileDOM) {
        var file = fileDOM.files[0], // 获取文件
            imageType = /^image\//,
            reader = '';
        // 判断是否支持FileReader
        if (window.FileReader) {
            reader = new FileReader();
        }
        // IE9及以下不支持FileReader
        else {
            alert("您的浏览器不支持图片预览功能，如需该功能请升级您的浏览器！");
            return;
        }
        // 读取完成
        reader.onload = function (event) {
            // 获取图片DOM
            var img = document.getElementById("preview-img");
            // 图片路径设置为读取的图片
            img.src = event.target.result;
            //console.log(event.target.result);
            smartcrop.crop(img, { width: 100, height: 100 }).then(function(result) {
                console.log(result.topCrop);
                {{--var x=result.topCrop.x;--}}
                {{--var y=result.topCrop.y;--}}
                {{--var width=result.topCrop.width;--}}
                {{--var height=result.topCrop.height;--}}
                {{--var fin_width=$("#width").val();--}}
                {{--var fin_height=$("#height").val();--}}
                {{--var fd = new FormData();--}}
                {{--fd.append('img', $("#file").get(0).files[0]);--}}
                {{--fd.append('_token', "{{csrf_token()}}");--}}
                {{--fd.append('x', x);--}}
                {{--fd.append('y', y);--}}
                {{--fd.append('width', width);--}}
                {{--fd.append('height', height);--}}
                {{--fd.append('fin_width', fin_width);--}}
                {{--fd.append('fin_height', fin_height);--}}
                {{--$.ajax({--}}
                    {{--method: "post",--}}
                    {{--url: "/model/crop",--}}
                    {{--data: fd,--}}
                    {{--contentType: false,--}}
                    {{--processData: false,--}}
                    {{--success: function (response) {--}}
                        {{--console.log(3);--}}
                        {{--console.log(response);--}}
                    {{--},--}}
                    {{--error: function (xhr) {--}}
                        {{--console.log(xhr);--}}
                    {{--}--}}
                {{--});--}}

            });
        };
        reader.readAsDataURL(file);
    }


</script>
</body>
</html>
