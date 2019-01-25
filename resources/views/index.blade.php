@extends('layouts.shop')
@section('content')
    <script>
        $(function () {
            $("#index").addClass("active-item");
        });
    </script>
    <!--  Loader  -->
    <div id="myloader">
        <div class="loader">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!--  Page Content  -->
    <div id="page-content">
        <!--  HomePage header  -->
        <div class="container">
            <div class="row no-margin wrap-slider">
                <div class="col-md-6 padding-leftright-null">
                    <div id="flexslider" class="home">
                        <ul class="slides">
                            <li style="background-image:url(assets/img/slider-shop-1.jpg)"></li>
                            <li style="background-image:url(assets/img/slider-shop-2.jpg)"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 padding-leftright-null">
                    <div id="home-slider" class="secondary-background">
                        <div class="text">
                            <h1 class="white margin-bottom">DLArtist<span>.</span></h1>
                            <p class="heading left grey-light">文章自动排版，插图自动生成，美化的创意设计网站</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END HomePage header  -->
        <div id="home-wrap" class="content-section">
            <!-- Services Section -->
            <div class="container">
                <div class="row no-margin padding-lg text-center">
                    <!-- Single Services -->
                    <div class="col-md-4 padding-leftright-null">
                        <div class="text padding-topbottom-null padding-md-bottom">
                            <i class="icon ion-ios-paper-outline color service margin-bottom-extrasmall"></i>
                            <h4 class="big margin-bottom-extrasmall">自动排版</h4>
                            <p class="margin-bottom-null">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                        </div>
                    </div>
                    <!-- END Single Services -->
                    <div class="col-md-4 padding-leftright-null">
                        <div class="text padding-topbottom-null padding-md-bottom">
                            <i class="icon ion-images color service margin-bottom-extrasmall"></i>
                            <h4 class="big margin-bottom-extrasmall">插图生成</h4>
                            <p class="margin-bottom-null">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-leftright-null">
                        <div class="text padding-topbottom-null">
                            <i class="icon ion-ios-color-wand-outline color service margin-bottom-extrasmall"></i>
                            <h4 class="big margin-bottom-extrasmall">图片美化</h4>
                            <p class="margin-bottom-null">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Services Section -->

            <div class="row no-margin">
                <div class="border-separator padding-onlytop-md"></div>
            </div>
            <!-- END Full Width Border Separator -->
        </div>
    </div>
    <!--  END Page Content -->
    </div>
    <!--  Main Wrap  -->

@endsection