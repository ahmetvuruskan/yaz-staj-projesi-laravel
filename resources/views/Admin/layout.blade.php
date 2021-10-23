<!doctype html>
<html lang="tr">
<head>
    <title>@yield('pagehead')</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link rel="icon" href="/images/settings/favicon.png" type="image/x-icon">
    <!-- VENDOR CSS -->
    <script src="/assets/bundles/libscripts.bundle.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/vendor/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="/assets/css/alertify.min.css">
    <link rel="stylesheet" href="/assets/vendor/charts-c3/plugin.css"/>


    <script src="/assets/vendor/jquery/jquery.js"></script>
    <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/alertify.min.js"></script>
    <script src="/assets/vendor/dropify/js/dropify.min.js"></script>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/color_skins.css">

</head>
<body class="theme-purple">




<div class="overlay"></div>

<div id="wrapper">

    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">

            <div class="navbar-left">
                <div class="navbar-btn">
                    <a href="index.html"><img src="/assets/images/icon-light.svg" alt="HexaBit Logo"
                                              class="img-fluid logo"></a>
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>
                <a href="javascript:void(0);" class="icon-menu btn-toggle-fullwidth"><i
                        class="fa fa-arrow-left"></i></a>
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-animated scale-right">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i
                                class="icon-grid"></i></a>
                        <ul class="dropdown-menu menu-icon app_menu">
                            <li>
                                <a class="#">
                                    <i class="icon-envelope"></i>
                                    <span>Inbox</span>
                                </a>
                            </li>
                            <li>
                                <a class="#">
                                    <i class="icon-bubbles"></i>
                                    <span>Chat</span>
                                </a>
                            </li>
                            <li>
                                <a class="#">
                                    <i class="icon-list"></i>
                                    <span>Task</span>
                                </a>
                            </li>
                            <li>
                                <a class="#">
                                    <i class="icon-globe"></i>
                                    <span>Blog</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="app-calendar.html" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i
                                class="icon-calendar"></i></a></li>
                    <li><a href="app-chat.html" class="icon-menu d-none d-sm-block"><i class="icon-bubbles"></i></a>
                    </li>
                </ul>
            </div>

            <div class="navbar-right">

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown dropdown-animated scale-left">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="icon-envelope"></i>
                                <span class="notification-dot"></span>
                            </a>
                            <ul class="dropdown-menu right_chat email">
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="/assets/images/xs/avatar4.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">James Wert <small
                                                        class="float-right">Just now</small></span>
                                                <span class="message">Lorem ipsum Veniam aliquip culpa laboris minim tempor</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{route('logout')}}" class="icon-menu"><i class="icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="rightbar" class="rightbar">
        <ul class="nav nav-tabs-new">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting">Settings</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat">Chat</a></li>
        </ul>

    </div>

    <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="{{route('admin.index')}}"><img src="/assets/images/icon-dark.svg" class="img-fluid logo"><span>Panel</span></a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i
                    class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div">
                    <img src="/images/users/{{\Illuminate\Support\Facades\Auth::user()->user_photo}}" class="user-photo">
                </div>
                <div class="dropdown">
                    <span>Hoşgeldin,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name"
                       data-toggle="dropdown"><strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="{{route('admin.profile')}}"><i class="icon-user"></i>Profil</a></li>

                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Ayarlar</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout')}}"><i class="icon-power"></i>Çıkış</a></li>
                    </ul>
                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">

                    <li class="active"><a href="{{route('admin.index')}}"><i class="icon-home"></i><span>Anasayfa</span></a>
                    </li>
                    <li><a href="{{route('admin.pages.index')}}"><i class="icon-settings"></i><span>Sayfa Ayarları</span></a></li>
                    <li>
                        <a href="#Ayarlar" class="has-arrow"><i class="icon-settings"></i><span>Ayarlar</span></a>
                        <ul>
                            <li><a href="{{route('admin.settings')}}"><i class="icon-settings"></i><span>Site Ayarları</span></a></li>
                            <li><a href="{{route('admin.payment.settings')}}"><i class="icon-settings"></i><span>Ödeme Ayarları</span></a>
                            <li><a href="{{route('admin.sliders')}}"><i class="icon-layers"></i><span>Slider Yönetimi</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#MagazaYonetimi" class="has-arrow"><i class="icon-bag"></i><span>Mağaza Yönetimi</span></a>
                        <ul>
                            <li><a href="{{route('admin.prouducts')}}"><i
                                        class="icon-social-dropbox"></i><span>Ürünler</span></a></li>
                            <li><a href="{{route('admin.categories')}}"><i class="icon-grid"></i><span>Kategoriler</span></a>
                            </li>
                            <li><a href="{{route('admin.orders')}}"><i class="icon-basket"></i><span>Siparişler</span></a></li>
                        </ul>
                    </li>






                </ul>
            </nav>
        </div>
    </div>

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>@yield('pagehead')</h2>

                </div>
                @yield('addnew')
            </div>
        </div>

        <div class="container-fluid">

            <div class="row clearfix">

                @yield('content')

            </div>
        </div>


    </div>

</div>


@if(session()->has('success'))
    <script>
        alertify.success('{{session('success')}}')
    </script>
@endif
@if(session()->has('error'))
    <script>
        alertify.error('{{session('error')}}')
    </script>
@endif

<!-- Javascript -->

<script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/bundles/mainscripts.bundle.js"></script>


<script src="/assets/bundles/c3.bundle.js"></script>




<script src="/assets/js/index.js"></script>
</body>
</html>
