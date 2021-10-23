<!doctype html>
<html lang="en">

<head>
    <title>:: Admin :: Giriş ::</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/color_skins.css">
</head>

<body class="theme-purple">
<!-- WRAPPER -->
<div id="wrapper" class="auth-main">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{route('admin.login')}}"><img src="/assets/images/icon-light.svg" width="30" height="30" class="d-inline-block align-top mr-2" alt="">Admin Panel Giriş</a>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#">Anasayfa</a></li>
                    {{--                     TODO Anasayfa Yönlendirmesi Yap--}}
                    </ul>
                </nav>
            </div>
            <div class="col-lg-8">
                <div class="auth_detail">
                    <h2 class="text-monospace">
                        Panele Erişmek İçin <br> Giriş Yapın
                    </h2>
                    <p></p>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="header">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif

                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif
                        <p class="lead">Giriş</p>
                    </div>
                    <div class="body">
                        <form class="form-auth-small" method="post" action="{{route('login.check')}}">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label sr-only">Email</label>
                                <input type="email" class="form-control" name="email"  value="{{old('email')}}" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label  class="control-label sr-only">Şifre</label>
                                <input type="password" name="password" class="form-control"   placeholder="Şifreniz">
                            </div>
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input name="remember_me" type="checkbox">
                                    <span>Beni Hatırla</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Giriş Yap</button>
                            <div class="bottom">
                                <span class="helper-text m-b-10"><i class="fa fa-lock"></i><a href="#">Şifremi unuttum</a></span>
                              {{--                              TODO:  Şifremi unuttumu yap--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->

<script src="/assets/bundles/libscripts.bundle.js"></script>
<script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/bundles/mainscripts.bundle.js"></script>
</body>
</html>
