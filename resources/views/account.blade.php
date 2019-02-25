@extends('layouts.edit')
@section('loader')
    <style>
        #loader {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 1;
            background-color: #fff;
            z-index: 1000;
            text-align: center;
        }


        #loading-image {

            /*vertical-align: middle;*/
            /*z-index: 1000;*/
            max-width: 350px;

            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>

    <div id="loader">
        <img id="loading-image"  src="images/preloader_3.gif" alt="Loading..." />
    </div>
@endsection
@section('head')
<style>
    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
    }

    .container{
        max-width: 960px;
    }
</style>

@endsection

@section('content')
    <div class="container py-5 mt-5">
        <div class="row">
            <div class="col-md-3 pr-4">
                <h5 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">账号设置</span>
                </h5>
                    <ul class="list-group mb-3" id="sideMenu">
                        <li id="menu1" class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <a href="#" id="publicInfo"><h6 class="my-0">个人资料</h6></a>
                                <small class="text-muted">Brief description</small>
                            </div>

                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed" id="menu2">
                            <div>
                                <a href="#" id="accountInfo"><h6 class="my-0">账户信息</h6></a>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed" id="menu3">
                            <div>
                                <a href="#" id="loginInfo"><h6 class="my-0">登录设置</h6></a>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </li>
                    </ul>
                </h4>
            </div>

            <div class="col-md-8" id="detail">

            </div>

        </div>
    </div>

@endsection

@section('script')
<script>
    //window loader$(window).on('load', function(){ ...});
    $(window).on('load',function(){
        // PAGE IS FULLY LOADED
        // FADE OUT YOUR OVERLAYING DIV
        $('#loader').fadeOut();
    });
    $(document).ready(function(){
        $('#accountMenu').addClass('active');
        $.ajax({
            url: 'account/publicInfo',
            type: 'get',
            success: function(data){
                $('#detail').html(data);
            }
        });
        $('#menu1').addClass('bg-light');
    });

    $('#publicInfo').click(function () {
        $.ajax({
            url: 'account/publicInfo',
            type: 'get',
            success: function(data){
                $('#detail').html(data);
            }
        });
        $("#sideMenu li[class*='bg-light']").removeClass('bg-light');
        $('#menu1').addClass('bg-light');
    });

    $('#accountInfo').click(function(){
        $.ajax({
            url: 'account/accountInfo',
            type: 'get',
            success: function(data){
                $('#detail').html(data);
            }
        });
        $("#sideMenu li[class*='bg-light']").removeClass('bg-light');
        $('#menu2').addClass('bg-light');
    });

    $('#loginInfo').click(function(){
        $.ajax({
            url: 'account/loginInfo',
            type: 'get',
            success: function(data){
                $('#detail').html(data);
            }
        });
        $("#sideMenu li[class*='bg-light']").removeClass('bg-light');
        $('#menu3').addClass('bg-light');
    });
</script>

@endsection




