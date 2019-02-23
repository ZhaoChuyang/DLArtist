@foreach($content as $t)
<?php
preg_match_all('/<img[^>]*?src="([^"]*?)"[^>]*?>/i',$t->content,$img);
$img_num=sizeof($img[1]);
$title=$t->title;
$time=$t->update;
$writer=$user_name;
$category=$t->category;
$content=strip_tags($t->content,'<p>');
$length=strlen($content);
$section_num=$img_num;
if($section_num)
    for($i=1;$i<=$section_num;$i++){
    $article_section[$i]=substr($content,($i-1)*(1/$section_num)*$length,$i*(1/$section_num)*$length);
}
$bg='https://unsplash.it/g/800/?image=491';
if ($img_num)$bg=$img[1][0];
for($i=1;$i<$img_num;$i++){
    $sub_img[$i]=$img[1][$i];
}
?>
@endforeach

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Responsive layout magazine style</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400|Vast+Shadow:400|Playfair+Display:400'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <style type="text/css">
        html,
        body {
            height: 100%;
        }
        body {
            font-size: 100%;
            line-height: 1.5;
            font-family: "Roboto Condensed", sans-serif;
            background: #fff;
        }
        body:after {
            content: '\003C\002F\003E';
            display: block;
            width: 100%;
            text-align: center;
            font-size: 8em;
            color: #e0e0e0;
        }
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }
        .group:after {
            content: "";
            display: table;
            clear: both;
        }
        img {
            vertical-align: baseline;
        }
        a {
            text-decoration: none;
        }
        .header-container {
            width: 100%;
            min-width: 280px;
            margin-bottom: 36px;
        }
        .header-container .right {
            background-image: url('https://unsplash.it/g/800/?image=491');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            min-height: 400px;
        }
        .header-container .left {
            padding: 2em;
            background: #f0f0f0;
        }
        .header-container .left .inner {
            position: relative;
            margin: auto;
            padding: 0;
            max-width: 400px;
        }
        .header-container .left .inner:before,
        .header-container .left .inner:after {
            content: '\f005';
            font-family: FontAwesome;
            color: #91927c;
            font-size: 3em;
            padding: 0 6px;
            display: block;
            width: 100%;
            text-align: center;
        }
        .header-container .left .inner:before {
            margin-bottom: 24px;
        }
        .header-container .left .inner:after {
            margin-top: 24px;
        }
        .header-container .left h1,
        .header-container .left h3,
        .header-container .left h4 {
            font-family: "Playfair Display", serif;
            font-size: calc(1em + 3.5vw);
            text-transform: uppercase;
            text-align: center;
            line-height: 1;
            color: #696a58;
            font-weight: 400;
        }
        .header-container .left h2 {
            font-family: "Vast Shadow";
            font-size: calc(1em + 1.5vw);
            text-transform: uppercase;
            text-align: center;
            line-height: 1;
            color: #696a58;
            font-weight: 400;
            margin: 0.5em 0;
        }
        .header-container .left h3 {
            font-size: calc(1.25em + 1vw);
            margin: 0.75em 0 0.5em;
        }
        .header-container .left h4 {
            font-size: calc(0.8em + 1vw);
            margin: 0.5em;
            position: relative;
        }
        .header-container .left h4:before {
            content: '\f083';
            font-family: FontAwesome;
            padding-right: 6px;
        }
        .header-container .left p {
            font-family: "Playfair Display", serif;
            text-align: center;
            line-height: 1.2;
            color: #696a58;
            font-weight: 400;
            font-size: calc(0.75em + 1vw);
            border-top: 7px solid #696a58;
            border-bottom: 7px solid #696a58;
            padding: 0.75em 0;
        }
        @media only screen and (min-width: 800px) {
            .header-container {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                min-height: 100vh;
            }
            .header-container .left,
            .header-container .right {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 50%;
                flex: 1 1 50%;
                width: 50%;
            }
            .header-container .right img {
                -o-object-fit: cover;
                object-fit: cover;
                -o-object-position: center center;
                object-position: center center;
                min-height: 100vh;
                min-width: 100%;
            }
            .header-container .left {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
            }
            .header-container .left .inner {
                max-width: 400px;
            }
        }
        .article-container {
            padding: 2em;
        }
        @media only screen and (min-width: 800px) {
            .article-container {
                -webkit-columns: 2;
                -moz-columns: 2;
                columns: 2;
                -webkit-column-gap: 3rem;
                -moz-column-gap: 3rem;
                column-gap: 3rem;
            }
        }
        .article-container p {
            font-family: serif;
            line-height: 1.4;
            color: #222;
            font-weight: 400;
            font-size: calc(0.75em + 0.75vw);
            margin-bottom: calc(0.75em + 0.75vw);
            widows: 3;
            orphans: 3;
        }
        .article-container p:first-of-type:first-letter {
            margin: 1% 3% -2px 0;
            padding: 0 5% 0;
            font-size: calc((0.75em + 0.75vw * 1.4) * 2.75);
            line-height: 1.5;
            float: left;
            color: #f0f0f0;
            font-weight: 700;
            background: tomato;
            vertical-align: bottom;
        }
        figure {
            display: block;
            margin: 0;
            padding: 0;
            -webkit-column-span: all;
            -moz-column-span: all;
            column-span: all;
            margin-top: calc(0.75em + 0.75vw);
            background: #c0c0c0;
            background: -webkit-repeating-linear-gradient(225deg, #e0e0e0, #e0e0e0 0.1em /* black stripe */, #fff 0, #fff 0.4em /* blue stripe */);
            background: repeating-linear-gradient(-135deg, #e0e0e0, #e0e0e0 0.1em /* black stripe */, #fff 0, #fff 0.4em /* blue stripe */);
        }
        figure img {
            max-width: 100%;
            height: auto;
            vertical-align: bottom;
            display: block;
            margin: 0 auto;
        }
        figure figcaption {
            font-size: calc(0.75em + 0.75vw);
            display: block;
            color: #999;
            padding: 6px 0 calc(0.75em + 0.75vw * 2);
            text-align: right;
            background: #fff;
        }
        figure figcaption:before {
            content: '\f083';
            font-family: FontAwesome;
            padding-right: 6px;
        }

    </style>
    <script src="http://127.0.0.1:8000/assets/js/jquery-3.2.1.min.js"></script>
</head>

<body>
<div class="header-container">
    <div class="left">
        <div class="inner">
            <h1><?php echo $title?></h1>
            <p>
                作者：<?php echo $writer?>
                <br>
                发表于：<?php echo $time?>
            </p>
            <h3>文章分类</h3>
            <h4><?php echo $category?></h4>
        </div>
    </div>
    <div class="right">
    </div>
</div>
<div class="article-container">
    <p><?php echo $article_section[1]?></p>

    <?php
        for ($i=2;$i<=$section_num;$i++){
    ?>
    <figure>
        <img src="<?php echo $sub_img[$i-1]?>" alt="" />
        <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus.</figcaption>
    </figure>
    <p><?php echo $article_section[$i]?></p>
    <?php
    }
    ?>
   </div>


</body>
<script>
    $(".header-container .right ").css('background-image','url(<?php echo $bg?>)')
</script>
</html>
