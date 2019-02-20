<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.13.5"> </script>

    <script src="modelFile/cocossd.js"> </script>

    <script>
        async function func()
        {
            const img = document.getElementById('img');

            cocoSsd.load().then(model => {

                model.detect(img).then(predictions => {
                    result = document.getElementById('result');
                    result.innerHTML = predictions[0].class;
                });
            });
        }

    </script>
</head>


<body>
<img id="img" src="images/dog.jpg"/>
<button type="button" onclick="func()">inference</button>
<p id="result">None</p>
</body>
</html>

