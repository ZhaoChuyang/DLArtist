<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.11.7"> </script>
    <!--Load the MobileNet model. -->
    <!--<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet@0.1.1"> </script>-->
    <script src="modelFile/mobilenet.js"></script>
    <script>
        async function func()
        {
            const img = document.getElementById('img');

            mobilenet.load().then(model => {
                // Classify the image.
                model.classify(img).then(predictions => {
                    //predictions是一个对象数组
                    //数组中的每一个对象 的属性是className、probably ... 
                    //可使用 console控制台打印查看详细信息
                    top0 = predictions[0];
                    res = document.getElementById("result");
                    res.innerHTML = top0.className;
                });
            });
        }

    </script>
</head>


<body>
<img id="img" src="http://localhost:8000/images/dog.jpg" width=224 height=224 crossorigin="anonymous"/>
<button type="button" onclick="func()">inference</button>
<p id="result">None</p>
</body>
</html>

