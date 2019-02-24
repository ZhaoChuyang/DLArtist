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
if ($html->find('img .important')) {
    $dossier_bg = 1;
    $dossier_bg_src = $html->find('img .important')->src;
}

//title
$title = $content[0]->title;

$description = "<p><em>Laker</em> is built on top of the
                Basically it's a set of files, styles, tips and tricks for building digital publications with HTML5.</p>
            <p>This publication demonstrates the main features of <em>Laker</em>. Take a look at the code and the
                documentation on to
                see how it's done. It's not that hard! ;) <br/>
            </p>
            <hr/>
            <br/></p>";

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
    <script>
    $(\".dossier-start-bg\").css('background-image','url($dossier_bg_src)')
    </script>
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

        ?>
        <div class="small-column float-right">
            <p>Class: <br/>
                &quot;small-column float-right&quot;<br/>
                Integer eu elit massa. Morbi vestibulum lacus a quam sagittis pulvinar tristique arcu posuere. Aliquam
                sollicitudin risus risus, at semper neque.</p>
        </div><!--small-column float-right-->


        <div class="large-column float-left">
            <p>Class: &quot;large-column float-left&quot;<br/>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas velit tortor, ullamcorper id laoreet
                vel, ultricies ut lorem. Curabitur porta orci ut lacus vestibulum porttitor. Suspendisse potenti. Donec
                sodales ante eu dui molestie euismod ultricies nisl sollicitudin. Phasellus eget mauris eu velit mollis
                consectetur a in elit. Pellentesque eu lorem nunc. Integer eu elit massa. Morbi vestibulum lacus a quam
                sagittis pulvinar tristique arcu posuere. Aliquam sollicitudin risus risus, at semper neque. Aliquam
                rhoncus rhoncus ultrices. Aliquam erat volutpat. Aenean in nibh vitae leo placerat viverra. Pellentesque
                non sapien ac orci fermentum molestie in vitae purus. Cras lacinia turpis nec orci blandit adipiscing.
                Morbi tempor commodo leo, quis scelerisque risus pretium quis. Cras suscipit magna eget tortor sagittis
                fringilla. Praesent arcu justo, ultrices eu interdum nec, ornare aliquam urna. Vivamus cursus posuere
                erat id faucibus.</p>
            <br/>
        </div><!--large-column float-left-->

        <!--Align text block on the right-->
        <div class="large-column float-right">
            <h1>Pellentesque vitae elit et enim tristique porta porttitor at dolor</h1>
        </div><!--Div large-column float-right-->

        <!--Small-Column left-->
        <div class="small-column float-left">
            <p>Class: "small-column float-left"<br/>Ut scelerisque cursus leo, id consectetur est semper a.</p>
        </div><!-- Div small-column float-left-->

        <div class="large-column float-right">
            <p>Class: "large-column float-right"<br/>Aliquam fermentum nibh quis risus placerat ultrices. Nulla congue
                lacus sed ligula commodo tincidunt. Aliquam erat volutpat. Nunc porta, velit non gravida pharetra, nisl
                dolor ultricies urna, at feugiat est nunc in mi. Fusce sagittis felis quis magna aliquam nec venenatis
                libero sodales. Fusce lacus metus, scelerisque at cursus in, sollicitudin et urna. Praesent in sodales
                nisl. Pellentesque ut dolor eget velit scelerisque faucibus quis hendrerit magna. Phasellus malesuada
                malesuada arcu, consequat pharetra odio bibendum ac. Curabitur sodales cursus eros luctus mattis.
                Quisque iaculis, quam eget egestas vestibulum, purus tellus ultrices elit, id dictum quam nisl in augue.
                Sed non mauris at sapien suscipit condimentum sed id leo. Maecenas vitae arcu lectus. Pellentesque
                pulvinar suscipit quam, sit amet lacinia nibh aliquam eget. Vivamus ornare ligula eget metus aliquet nec
                vehicula sapien suscipit. Ut scelerisque cursus leo, id consectetur est semper a.</p>
            <br/><br/>
        </div><!--Div large-column float-right-->


        <div class="full-column">
            <h1>Class: "full-column" – <br/>This headline uses the whole page width.</h1>
        </div><!--Div full-column-->

        <div class="medium-column float-left">
            <p>Class: "medium-column float-left"<br/>
                Morbi semper ultrices porta. Aenean dignissim, sapien eget sodales mollis, massa urna malesuada elit,
                sit amet vulputate justo augue in massa. Praesent mattis accumsan blandit. Mauris nec enim ante. Sed
                fringilla interdum eros, nec lacinia turpis iaculis vel. Vestibulum leo ipsum, consequat a dignissim sit
                amet, egestas in urna. Donec nisl velit, pulvinar id ullamcorper vitae, imperdiet et leo. Donec
                ultricies cursus varius. Pellentesque elit arcu, pulvinar in fermentum non, faucibus eu quam.
                Suspendisse mollis aliquam sagittis. Vestibulum pellentesque accumsan arcu, vitae mattis tellus luctus
                id. Vivamus sed condimentum leo.</p>
        </div><!--Div medium-column float-left-->

        <div class="medium-column float-right">
            <p>Class: "medium-column float-right"<br/> Aliquam fermentum nibh quis risus placerat ultrices. Nulla congue
                lacus sed ligula commodo tincidunt. Aliquam erat volutpat. Nunc porta, velit non gravida pharetra, nisl
                dolor ultricies urna, at feugiat est nunc in mi. Fusce sagittis felis quis magna aliquam nec venenatis
                libero sodales. Fusce lacus metus, scelerisque at cursus in, sollicitudin et urna. Praesent in sodales
                nisl. Pellentesque ut dolor eget velit scelerisque faucibus quis hendrerit magna. Phasellus malesuada
                malesuada arcu, consequat pharetra odio bibendum ac. Curabitur sodales cursus eros luctus mattis.
                Quisque iaculis, quam eget egestas vestibulum, purus tellus ultrices elit, id dictum quam nisl in augue.
                Sed non mauris at sapien suscipit condimentum sed id leo. Maecenas vitae arcu lectus. Pellentesque
                pulvinar suscipit quam, sit amet lacinia nibh aliquam eget. Vivamus ornare ligula eget metus aliquet nec
                vehicula sapien suscipit. Ut scelerisque cursus leo, id consectetur est semper a.</p>
        </div><!--Div medium-column float-left-->

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
</script>


</body>
</html>