@extends('layouts.personal')

@section('head')
    <!--jQuery-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <!--JQuery Modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

@endsection

@section('content')
    <style>
        .carousel-item {
            height: 100vh;
            min-height: 350px;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url('images/test_1.jpeg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-4" style="color:white">智能排版</h2>
                        <p class="lead">Tidy and elegant typesetting solution.</p>

                        <a href="/edit_1" class="btn btn-outline-light ">See details</a>

                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('images/test_2.jpeg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-4" style="color:white">专业排版</h2>
                        <p class="lead">Powerful and professional typesetting solution.</p>

                        <a href="/edit_2" class="btn btn-outline-light ">See details</a>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('/images/test_3.jpeg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-4" style="color:white">即将上线</h2>
                        <p class="lead">This is a description for the third slide.</p>
                        <a href="#" class="btn btn-outline-light ">See details</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>

    <!-- Page Content -->
    {{--<section class="py-5">--}}
        {{--<div class="container">--}}
            {{--<h1 class="display-4">Full Page Image Slider</h1>--}}
            {{--<p class="lead">The background images for the slider are set directly in the HTML using inline CSS. The images in this snippet are from <a href="https://unsplash.com">Unsplash</a>, taken by <a href="https://unsplash.com/@joannakosinska">Joanna Kosinska</a>!</p>--}}
        {{--</div>--}}
    {{--</section>--}}
@endsection