<?php

use KubAT\PhpSimple\HtmlDomParser;

$html_str = $content[0]->content;
$html = HtmlDomParser::str_get_html($html_str);

$string = $html->plaintext;
$len = strlen($string);
$tag = 1;
if ($len < 2000) {
    $tag = 1;
} else if ($len < 20000) {
    $tag = 2;
} else
    $tag = 3;

$img_num = sizeof($html->find('img'));

//$dossier_background
$dossier_bg = 0;
if ($html->find('img[class*=important]')) {
    $dossier_bg = 1;
    $dossier_bg_src = $html->find('img[class*=important]', 0)->src;

}

//title
$title = $content[0]->title;

$description = "<p>每当我走近那片小树林，便很自然地放慢晨练的速度，悄悄地，轻轻地走近它，生怕惊扰了鸟儿们的酣梦，也怕惊动树木生长的灵性。</p>";
//
//slideShow
$slideShow = 0;
//用过的图片
$imgUsed = $dossier_bg;


?>
        <!DOCTYPE html>
<html xmlns:csi="http://www.massimocorner.com/libraries/csi/" lang="de">
<head>

    <!--
    ############################################################################
    META information ###########################################################
    ############################################################################
    -->

    <meta charset="utf-8">

    <!--Prevent pinch to zoom on iOS devices-->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;"/>

    <!--Allow saving as a web app on the home screen on iOS Devices (doesn't apply in Baker)-->
    <meta name="apple-mobile-web-app-capable" content="yes"/>

    <!--If the page is saved as a web app, the statusbar will be black-translucent (doesn't apply in Baker)-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>

    <!--Prevent phone number detection on iOS devices-->
    <meta name="format-detection" content="telephone=no"/>


    <!--Title. The content of the title is displayed on the loading screen on iOS devices-->
    <title>Model_3</title>

    <!--
    ############################################################################
    Stylesheets ################################################################
    ############################################################################
    -->

    <!--Loading the main style sheet-->
    <link href="http://127.0.0.1:8000/model_css/styles/styles.css" rel="stylesheet" type="text/css"/>

    <!--Loading the dossier specific css-->
    <link href="http://127.0.0.1:8000/model_css/styles/dossiers/03.css" rel="stylesheet" type="text/css"/>
    <link href="http://127.0.0.1:8000/model_css/slideshow.css" rel="stylesheet" type="text/css">
    <!--
    ############################################################################
    Javascripts ################################################################
    ############################################################################
    -->

    <script src="http://127.0.0.1:8000/model_js/js/Hyphenator.js" type="text/javascript"></script>
    <script src="http://127.0.0.1:8000/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/model_js/js/tmt_core.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/model_js/js/tmt_net.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/model_js/js/tmt_csi.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/model_js/js/article-nav.js"></script>
    <script src="http://127.0.0.1:8000/model_js/js/slideshow.js"></script>
    <!--Mandatory JavaScripts (Uncomment if not used to speed up performance)
    <script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
    <script src="js/jquery.touchSwipe-1.2.1.js" type="text/javascript"></script>
    -->

</head>

<body>

<!--
############################################################################
Start dossier navigation in navigation bar #################################
############################################################################
-->


<!--Implementing the Dossier-Number-->
<div id="dossier-number" class="dossier-number"><p>03</p></div>

<!--
############################################################################
End dossier navigation in navigation bar ###################################
############################################################################
-->

<!--Enable text hyphenation with Hyphenator.js-->
<div class="hyphenate">


    <!--
    ############################################################################
    Start content ##############################################################
    ############################################################################
    -->

<?php
if ($dossier_bg) {
    echo "
    <div class=\"dossier-start-bg\">
        <!--(if you want to place something on top of the picture, place it here-->
    </div>
    ";
}

?>

<!--Arrow which indicates the start of the text-->
    <div class="dossier-headline-arrow"><img src="http://127.0.0.1:8000/images/dossier-headline-arrow.png"/></div>

{{--TITLE--}}
<!--"content-element" ensures, that content is placed within the right margins-->
    <div class="content-element">
        <!--Starting Headline-->
        <div class="starting-headline">
            <h1 id="title_1"><?php echo $title ?></h1>
        </div><!--Div starting headline-->
    </div><!--Div content element-->

    <!--"content-element" ensures, that content is placed within the right margins-->
    <div class="content-element">
        <!--Main content-->

        {{--DESCRIPTION--}}
        <?php
            echo "
            <div class=\"large-column float-left\" id=\"description\">
            $description
            <hr/>
            <br/>
        </div>";
        ?>
        <div class="small-column float-right">

        </div><!--small-column float-right-->


        <div class="large-column float-left">
            <div style="clear: both;"></div>

            <?php
                $current_text=0;
                $allElement=$html->find('*');
                $allImg=$html->find('img');
                foreach($allElement as $element){
                    if($current_text>200){
                        $current_Img=$html->find('img', $imgUsed++);

                        $current_text=0;
                    }
                    if($element->find ('img', 0)==null){
                        echo $element;
                        $current_text+=strlen($element->plaintext);
                    }
                    else if($element->find ('img', 0)!=null && strpos($element->find ('img', 0)->class, 'important') == false){
                        $img=$element->find('img', 0);
                        echo "<p>$element->plaintext</p>";
                        echo "<div class=\"media-right\">
    <img src=\"$img->src\" alt=\"\" width=\"400\" height=\"600\" /></div>";
                        $current_text+=strlen($element->plaintext);

                    }
                }
            ?>

        </div><!--large-column float-left-->

    </div><!--Div content-element-->

    <div class="slideshow-container" style="margin-left: 28px;" <?php if ($slideShow == 0) echo "hidden"?>>
        <?php
        for($i = 0; $i < $img_num - $imgUsed; $i++){
        ?>
        <div class="mySlides fade">
            <div class="numbertext"><?php echo $i + 1 ?> / <?php echo $img_num - $imgUsed ?></div>
            <img src="<?php echo $html->find('img', $i+$imgUsed)->src ?>" style="width:100%">
            <div class="text">#<?php echo $i+1 ?></div>
        </div>
        <?php
        }
        ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align:center" style="margin-left: 28px;" <?php if ($slideShow == 0) echo "hidden"?>>
        <?php
        for($i = 0;$i < $img_num - $imgUsed; $i++){
        ?>
        <span class="dot" onclick="currentSlide(<?php echo $i + 1?>)"></span>
        <?php
        }
        ?>
    </div>


    <!--
  ############################################################################
  End of content #############################################################
  ############################################################################
  -->


</div><!--Div hyphenate-->


<!--
############################################################################
Start Footer ###############################################################
############################################################################
-->


<!--
############################################################################
End Footer #################################################################
############################################################################
-->
<div id="raw_article" style="display: none;">

</div>

<script>
    $(document).ready(function () {
        currentSlide(1);

    });
    <?php if($dossier_bg) {?>$(".dossier-start-bg").css('background-image',"url(<?php echo $dossier_bg_src;?>)");<?php } ?>
</script>


</body>
</html>