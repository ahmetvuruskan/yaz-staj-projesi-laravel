<!DOCTYPE html>
<html
    lang="{{\Illuminate\Support\Facades\Lang::getLocale()}}-{{strtoupper(\Illuminate\Support\Facades\Lang::getLocale())}}">

<head>
    <title>@hasSection('title')
            @yield('title')
        @else
            {{$title}}
        @endif
    </title>
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/settings/{{$icon}}" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <link
        href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:100,300,400,500,700,900%7CRoboto+Condensed:100,300,400,500,700"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/frontend/css/icon-font-linea.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/multirange.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/effect.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/cartpage.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/contact.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/product.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/category.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/home.css">
    <link rel="stylesheet" type="text/css" href=/frontend/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/responsive.css">
</head>
<body>


<!-- Header Box -->
<div class="wrappage">
    <header class="relative full-width box-shadow">
        <div class="clearfix container-web relative">
            <div class=" container">
                <div class="row">
                    <div class=" header-top">
                        <p class="contact_us_header col-md-4 col-xs-12 col-sm-3 clear-margin">
                            <img src="/frontend/img/icon_phone_top.png" alt="Icon Phone Top Header"/> Müşteri Hizmetleri
                            <span
                                class="text-red bold">{{$phone_gsm}}</span>
                        </p>


                    </div>
                </div>
                <div class="row">
                    <div class="clearfix header-content full-width relative">
                        <div class="clearfix icon-menu-bar">
                            <i class="data-icon data-icon-arrows icon-arrows-hamburger-2 icon-pushmenu js-push-menu"
                               aria-hidden="true"></i>
                        </div>
                        <div class="clearfix logo">
                            <a href="{{route('index')}}"><img alt="Logo" src="/images/settings/{{$logo}}"/></a>
                        </div>
                        <div class="clearfix search-box  ">
                            <form method="GET" action="{{route('search')}}" class="">
                                <input type="text" name="s" placeholder="Ara">
                                <button type="submit" class="animate-default button-hover-red">Ara</button>
                            </form>
                        </div>


                    </div>
                    <div class="mask-search absolute clearfix" onclick="hiddenBoxSearchMobile()"></div>
                    <div class="clearfix box-search-mobile">
                    </div>
                </div>
            </div>
            <div class="row">
                <a class="menu-vertical hidden-md hidden-lg" onclick="showMenuMobie()">
                    <span class="animate-default"><i class="fa fa-list" aria-hidden="true"></i> all categories</span>
                </a>
            </div>
        </div>


    </header>
    @yield('content')
    <div class=" support-box full-width clear-padding bottom-margin-default">
        <div class="container-web clearfix">
            <div class=" container border top-padding-default bottom-padding-default">
                <div class="row">
                    <div class=" support-box-info relative col-md-3 col-sm-3 col-xs-6">
                        <img src="/frontend/img/icon_free_ship.png" class="absolute"/>
                        <p>Ücretsiz kargo</p>
                        <p>150₺ ve üstüne </p>
                    </div>
                    <div class=" support-box-info relative col-md-3 col-sm-3 col-xs-6">
                        <img src="/frontend/img/icon_support.png" class="absolute">
                        <p>7/24</p>
                        <p>Müşteri Desteği</p>
                    </div>
                    <div class=" support-box-info relative col-md-3 col-sm-3 col-xs-6">
                        <img src="/frontend/img/icon_patner.png" class="absolute">
                        <p>%100 Müşteri Memnuniyeti</p>
                        <p></p>
                    </div>
                    <div class=" support-box-info relative col-md-3 col-sm-3 col-xs-6">
                        <img src="/frontend/img/icon_phone_big.png" class="absolute">
                        <p><a style="text-decoration: black" href="tel:{{$phone_gsm}}">{{$phone_gsm}}</a></p>
                        <p>Destek Alın</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Support Box -->
</div>
<!-- End Content Box -->
<!-- Footer Box -->
<footer class="relative full-width">

    <div class="clearfix container-web relative">
        <div class=" container clear-padding">
            <div class="row">

                <div class="clearfix col-md-3 col-sm-6 col-xs-12 text-footer">
                    <p>Bilgi Alın</p>
                    <ul class="list-footer">
                        <li><a href="{{route('page.detail',['slug'=>'hakkimizda'])}}">Hakkımızda</a></li>
                        <li><a href="{{route('page.detail',['slug'=>'kullanim-kosullari'])}}">Kullanım Koşulları</a></li>
                        <li><a href="{{route('page.detail',['slug'=>'mesafeli-satis-sozlesmesi'])}}">Mesafeli Satış Sözleşmesi</a></li>
                        <li><a href="{{route('page.detail',['slug'=>'gizlilik-sozlesmesi'])}}">Gizlilik Sözleşmesi</a></li>
                    </ul>
                </div>

                <div class="clearfix col-md-3 col-sm-6 col-xs-12 text-footer">
                    <p>contact us</p>
                    <ul class="icon-footer">
                        <li><i class="fa fa-home" aria-hidden="true"></i>{{$adres}} {{$il}} {{$ilce}}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i> {{$mail}}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{$phone_gsm}}</li>
                        <li><i class="fa fa-fax" aria-hidden="true"></i> {{$phone_sabit}}</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class=" bottom-footer full-width">
        <div class="clearfix container-web">
            <div class=" container">
                <div class="row">
                    <div class="clearfix col-md-7 clear-padding copyright">
                        <p>Copyright © 2021 by Ahmet Vuruşkan</p>
                    </div>
                    <div class="clearfix footer-icon-bottom col-md-5 float-right clear-padding">
                        <div class="icon_logo_footer float-right">
                            <img src="/frontend/img/image_payment_footer-min.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="/frontend/js/jquery-3.3.1.min.js" defer=""></script>
<script src="/frontend/js/multirange.js" defer=""></script>
<script src="/frontend/js/slick.min.js" defer=""></script>
<script src="/frontend/js/bootstrap.min.js" defer=""></script>
<script src="/frontend/js/owl.carousel.min.js" defer=""></script>
<script src="/frontend/js/sync_owl_carousel.js" defer=""></script>
<script src="/frontend/js/scripts.js" defer=""></script>
</body>
</html>
