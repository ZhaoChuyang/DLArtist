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
    $latch=$length/2;
    while($latch%3!=1)$latch++;
    $first_section=substr($content,0,$latch);
    $second_section=substr($content,$latch,$length);
    $bg='http://127.0.0.1:8000/images/dossier-01/dossier-start-bg.jpg';
    $left_bg='http://127.0.0.1:8000/images/dossier-01/image-in-text.jpg';
    $right_bg='http://127.0.0.1:8000/images/dossier-01/image-in-text.jpg';
    if($img_num){
        $bg=$img[1][0];
        if($img_num>1){
            $right_bg=$img[1][1];
        }
        if($img_num>2){
            $left_bg=$img[1][2];
        }
    }
?>
@endforeach
<!DOCTYPE html>
<html xmlns:csi="http://www.massimocorner.com/libraries/csi/" lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $title ?> with mode1</title>
    <link href="http://127.0.0.1:8000/model_css/styles/styles.css" rel="stylesheet" type="text/css" />
    <link href="http://127.0.0.1:8000/model_css/styles/dossiers/01.css" rel="stylesheet" type="text/css" />
    <link href="http://127.0.0.1:8000/model_css/slideshow.css" rel="stylesheet" type="text/css">
    <script src="http://127.0.0.1:8000/model_js/js/Hyphenator.js" type="text/javascript"></script>
    <script src="http://127.0.0.1:8000/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/model_js/js/tmt_core.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/model_js/js/tmt_net.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/model_js/js/tmt_csi.js"></script>
    <script src="http://127.0.0.1:8000/model_js/js/jquery.touchSwipe-1.2.1.js" type="text/javascript"></script>
    <script src="http://127.0.0.1:8000/model_js/js/slideshow.js"></script>
</head>
<body>
<div id="dossier-number" class="dossier-number"><p>01</p></div>
<div class="hyphenate">
    {{--头图--}}
    <div class="dossier-start-bg">
    </div>
    <div class="dossier-headline-arrow"><img src="http://127.0.0.1:8000/images/dossier-headline-arrow.png" /></div>
    <div class="content-element">
        <div class="starting-headline">
            <h1><?php echo $title ?></h1>
        </div>
    </div>
    <div class="content-element">
        <div class="large-column float-left">
            <p>作者：<em><?php echo $writer?></em></p>
            <p>发表时间：<em><?php echo $time?></em></p>
            <p>文章分类：<em><?php echo $category?></em></p>
            <hr /><br />
        </div>
        <div class="large-column float-left">
            <div class="media-right">
                <img src="<?php echo $right_bg?>" width="400" height="600" />
            </div>
            <p><?php echo $first_section?></p>
        </div>
        <div class="large-column float-right">
            <div class="media-left">
                <img src="<?php echo $left_bg?>" width="400" height="600" />
            </div>
            <p><?php echo $second_section?></p>
           </div><!--Div large-column float-right-->
        <div class="large-column float-left">
            <h2>Slideshow</h2>
        </div><!--Div dossier float-left-->
    </div><!--Div content-element-->

    <?php
        $remainder_num=0;
    if ($img_num>3){
        $remainder_num=$img_num-3;
    ?>
    <div class="slideshow-container" style="margin-left: 28px;">
        <?php
            for($i=0;$i<$remainder_num;$i++){
        ?>
        <div class="mySlides fade">
            <div class="numbertext"><?php echo $i+1 ?> / <?php echo $remainder_num ?></div>
            <img src="<?php echo $img[1][3+$i] ?>" style="width:100%">
            <div class="text">New York City #1</div>
        </div>
        <?php
            }
         ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <?php
    }
    ?>
    <br>
    <div style="text-align:center" style="margin-left: 28px;">
        <?php
        for($i=0;$i<$remainder_num;$i++){
            ?>
        <span class="dot" onclick="currentSlide(<?php echo $i+1?>)"></span>
        <?php
            }
        ?>
    </div>


</div><!--Div hyphenate-->




<!--Include footer data from inc/footer.html-->
{{--<div class="footer">--}}
    {{--<div id="includeFooter" csi:src="inc/footer.html"></div>--}}
{{--</div><!--Div footer-->--}}

<script>
    $(document).ready(function () {
        currentSlide(1);
    });
    $(".dossier-start-bg").css('background-image','url(<?php echo $bg?>)')
</script>
</body>
</html>