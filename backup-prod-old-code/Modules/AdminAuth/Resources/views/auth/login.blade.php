<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if (isset($title))
            {{ ucfirst($title).' :: '.config('app.name')}}
        @else
            @yield('title', 'Login'){{' :: '.config('app.name')}}
        @endif
    </title>

    <!--STYLESHEET-->
    <!--=================================================-->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="/html/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="/html/css/nifty.min.css" rel="stylesheet">

    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="/html/plugins/magic-check/css/magic-check.min.css" rel="stylesheet">

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="/html/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="/html/plugins/pace/pace.min.js"></script>

    <!--jQuery [ REQUIRED ]-->
    <script src="/html/js/jquery.min.js"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="/html/js/bootstrap.min.js"></script>

    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="/html/js/nifty.min.js"></script>
    <link href="/html/css/nifty-custom.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="<?=url('/favicon.png')?>" type="image/x-icon" sizes="32x32">
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body class="page-login">
<div id="container" class="cls-container">

    <!-- BACKGROUND IMAGE -->
    <!--===================================================-->
    <div id="bg-overlay"></div>


    <!-- LOGIN FORM -->
    <!--===================================================-->
    <div class="cls-content">
        <div class="cls-content-sm panel">
            <div class="panel-body">
                <div class="mar-ver pad-btm header">
                    <h1 class="h3">
                        <img
                            src="/images/logo_king.png"
                            alt="Logo Kingstudy"
                            width="150px"
                        />
                    </h1>
                    <p>Đăng nhập hệ thống KING-STUDY</p>
                </div>
                @if ($errors->has('email'))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <span>{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST" class="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <span class="icon"><img src="/html/img/icons/icon-user.png" alt=""></span>
                        <input id="email" type="text" placeholder="Nhập Email" class="form-control"
                               name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <span class="icon"><img src="/html/img/icons/icon-pass.png" alt=""></span>
                        <input id="password" type="password" class="form-control" name="password"
                               value="{{ old('password') }}" required placeholder="Nhập mật khẩu">
                    </div>
                    <div class="checkbox pad-btm text-left">
                        <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
                        <label for="demo-form-checkbox">Nhớ mật khẩu</label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
    <!--===================================================-->

</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


</body>
</html>
