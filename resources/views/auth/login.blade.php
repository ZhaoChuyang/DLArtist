<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">
<nav class="navbar navbar-expand-md navbar-light bg-white fixed-top border-bottom" style="z-index: 999">
    <a class="navbar-brand ml-1" href="{{ url('/') }}">
        {{--{{ config('app.name', 'Laravel') }}--}}
        <img src="assets/img/LOGO_text.png" style="height:35px;">
    </a>
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" href="index">主页</a>
                </li>

                <li class="nav-item dropdown mr-3">
                    <a id="blogMenu"class="nav-link" href="categories">发现想法</a>
                </li>

                <li id='editMenu' class="nav-item mr-3">
                    <a class="nav-link" href="edit">发表看法</a>
                </li>

                <li class="nav-item mr-3">
                    <a class="nav-link" href="contact">消息</a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('登录') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('注册') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item ">
                        <a id="accountMenu" class="nav-link" href="/account" >
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<form method="POST" action="{{ route('login') }}" class="form-signin mt-5">
    @csrf
    <img class="mb-4" src="/assets/img/LOGO.png" alt="" width="80" height="80">
    <h1 class="h3 mb-3 font-weight-normal">{{ __('Please login') }}</h1>
    <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
    <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
    @endif
    <label for="password" class="sr-only">{{ __('Password') }}</label>
    <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
    @endif
    <div class="checkbox mb-3">
        <label>
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
    <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>
</form>
</body>
</html>

