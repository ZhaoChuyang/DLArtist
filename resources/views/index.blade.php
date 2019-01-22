@extends('layouts.shop')

@section('content')

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
            <div class="container">
                <!--  Portfolio  -->
                <section id="projects" data-isotope="load-simple" class="page padding-bottom-null">
                    <!--  Filters  -->
                    <div class="row no-margin text-center">
                        <div class="col-sm-12 padding-leftright-null">
                            <div class="filter-wrap left">
                                <ul class="col-md-12 filters padding-leftright-null">
                                    <li data-filter="*" class="is-checked">All</li>
                                    <li data-filter=".design">Design</li>
                                    <li data-filter=".branding">Branding</li>
                                    <li data-filter=".photography">Photography</li>
                                    <li data-filter=".web">Web</li>
                                    <li data-filter=".app">Apps</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--  END Filters  -->
                    <div class="projects-items equal three-columns">
                        <!-- Single Project -->
                        <div class="single-item shop one-item design branding">
                            <div class="item">
                                <img src="assets/img/shop1.jpg" alt="">
                                <div class="content">
                                    <i class="icon ion-ios-cart-outline"></i>
                                    <div>
                                        <h3>Housery</h3>
                                        <span class="price">$182</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet</p>
                                </div>
                                <a href="single-product.html" class="link"></a>
                            </div>
                        </div>
                        <!-- END Single Project -->
                        <div class="single-item shop one-item branding web">
                            <div class="item">
                                <img src="assets/img/shop2.jpg" alt="">
                                <div class="content">
                                    <i class="icon ion-ios-cart-outline"></i>
                                    <div>
                                        <h3>Greenline</h3>
                                        <span class="price">$50</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet</p>
                                </div>
                                <a href="single-product.html" class="link"></a>
                            </div>
                        </div>
                        <div class="single-item shop one-item app design">
                            <div class="item">
                                <img src="assets/img/shop3.jpg" alt="">
                                <div class="content">
                                    <i class="icon ion-ios-cart-outline"></i>
                                    <div>
                                        <h3>Enfasi</h3>
                                        <span class="price">$13</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet</p>
                                </div>
                                <a href="single-product.html" class="link"></a>
                            </div>
                        </div>
                        <div class="single-item shop one-item photography">
                            <div class="item">
                                <img src="assets/img/shop4.jpg" alt="">
                                <div class="content">
                                    <i class="icon ion-ios-cart-outline"></i>
                                    <div>
                                        <h3>Pulse</h3>
                                        <span class="price">$730</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet</p>
                                </div>
                                <a href="single-product.html" class="link"></a>
                            </div>
                        </div>
                        <div class="single-item shop one-item app design">
                            <div class="item">
                                <img src="assets/img/shop5.jpg" alt="">
                                <span class="label">Sale</span>
                                <div class="content">
                                    <i class="icon ion-ios-cart-outline"></i>
                                    <div>
                                        <h3>Archotale</h3>
                                        <span class="price">$48</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet</p>
                                </div>
                                <a href="single-product.html" class="link"></a>
                            </div>
                        </div>
                        <div class="single-item shop one-item web branding">
                            <div class="item">
                                <img src="assets/img/shop6.jpg" alt="">
                                <div class="content">
                                    <i class="icon ion-ios-cart-outline"></i>
                                    <div>
                                        <h3>iPachage</h3>
                                        <span class="price">$25</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet</p>
                                </div>
                                <a href="single-product.html" class="link"></a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END Portfolio -->
            </div>
            <!-- Full width Border Separator -->
            <div class="row no-margin">
                <div class="border-separator padding-onlytop-md"></div>
            </div>
            <!-- END Full Width Border Separator -->
            <!-- Newsletter -->
            <div class="container padding-onlybottom-md">
                <div class="row no-margin padding-onlytop-lg">
                    <div class="col-md-12 padding-leftright-null">
                        <div class="text text-center padding-top-null padding-onlybottom-sm">
                            <h2 class="heading margin-bottom-null">Subscribe to our newsletter<span class="color">.</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12 padding-leftright-null">
                        <div class="text text-center padding-topbottom-null">
                            <p class="small margin-bottom">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut<br>labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                            <div id="newsletter-form">
                                <form class="search-form">
                                    <div class="form-input">
                                        <input type="text" placeholder="Your email ID">
                                        <span class="form-button">
                                                    <button type="button">Subscribe</button>
                                                </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Newsletter -->
        </div>
    </div>
    <!--  END Page Content -->
    </div>
    <!--  Main Wrap  -->

@endsection