@extends('Frontend.layout')
@section('content')
{{--@dd($data)--}}
    <!-- End Header Box -->
    <!-- Content Box -->
    <div class="relative clearfix full-width">
        <!-- Menu & Slide -->
        <div class="clearfix container-web relative">
            <div class=" container relative">
                <div class="row">
                    <div class="clearfix relative menu-slide clear-padding bottom-margin-default">
                        <!-- Menu -->
                        <div class="clearfix menu-web relative">
                            <ul>
                                @foreach($data['categories'] as $category)
                                    <li><a href="{{route('category.list',['slug'=>$category->category_slug])}}"><p>{{$category->category_name}}</p></a></li>

                                @endforeach
                            </ul>


                        </div>
                        <!-- Slide -->
                        <div class="clearfix slide-box-home slide-v1 relative">
                            <div class="clearfix slide-home owl-carousel owl-theme">
{{--                                Sliderlerimizi Çektik--}}
                                @foreach($data['sliders'] as $slider)
                                    <div class="item"><img src="/images/sliders/{{$slider->slider_photo}}"></div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <!-- End Menu & Slide -->
                </div>
            </div>
        </div>
        <!-- Content Product -->
        <div class="clearfix box-product full-width top-padding-default bg-gray">
            <div class="clearfix container-web">
                <div class=" container">

                    <div class="clearfix content-product-box bottom-margin-default full-width">

                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Product -->
        <!-- Product Box -->
        <div class="top-margin-default container-web">
            <div class=" container">
                <div class="row">
                    <div class="clearfix title-box full-width border">
                        <div class="clearfix name-title-box title-category title-green-bg relative">
                            <img  src="/frontend/img/icon_computer.png" class="absolute"/>
                            <p>Bilgisayar</p>
                        </div>
                            <div class="clearfix menu-title-box">
                                <p class="view-all-product-category title-hover-red"><a href="{{route('category.list',['slug'=>$data['category_slug'][1]])}}" class="animate-default">Tüm Ürünler</a></p>
                            </div>
                    </div>
                    <div class="display-table bottom-margin-default full-width">
                        <div
                            class="clearfix clear-padding list-logo-category border no-border-t no-border-r list-logo-category-v1 float-left">
                            <ul>
                                <li><a href="#"><img src="/frontend/img/logo_3.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_4.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_5.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_6.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_1.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_2.png" ></a></li>
                            </ul>
                        </div>
                        <div
                            class=" banner-category banner-category-v1 float-left relative effect-bubba zoom-image-hover">
                            <img src="/frontend/img/banner1.png" >
                            <a href="#"></a>
                        </div>
                        <div class="clearfix list-products-category list-products-category-v1 float-left relative">
                            <div
                                class="box-food-content relative animate-default active-box-category hidden-content-box border-collapsed-box"
                                id="confectionery">
                                @foreach($data['computer'] as $computer)
                                    <div
                                        class="clearfix relative product-no-ranking border-collapsed-element percent-content-2">
                                        <div class="effect-hover-zoom center-vertical-image">
                                            <img width="200" height="200" src="/images/products/{{$computer->photo}}" >
                                            <a href="{{route('urun.detay',['slug'=>$computer->product_slug])}}"></a>
                                        </div>
                                        <div class="clearfix absolute name-product-no-ranking">
                                            <p class="title-product clearfix full-width title-hover-black"><a href="#">{{$computer->product_name}}</a></p>
                                            <p class="clearfix price-product">{{$computer->product_price}} ₺
                                            </p>
                                        </div>
                                    </div>

                                @endforeach

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Product Box -->
        <!-- Banner Full With -->
        <div class="clearfix relative full-width bottom-margin-default">
            <div class="clearfix container-web">
                <div class=" container banner_full_width">
                    <div class="row overfollow-hidden banners-effect5 relative">
                        <img src="/frontend/img/banner_full_w.png" >
                        <a href="#"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Full With -->
        <!-- Product Box -->
        <div class=" container-web">
            <div class=" container">
                <div class="row">
                    <div class="clearfix title-box full-width border">
                        <div class="clearfix name-title-box title-category title-jungle-green-bg relative">
                            <img src="/frontend/img/icon_mobile.png" class="absolute"/>
                            <p>Telefon & Tablet</p>
                        </div>
                        <div class="clearfix menu-title-box">
                            <p class="view-all-product-category title-hover-red"><a href="{{route('category.list',['slug'=>$data['category_slug'][2]])}}" class="animate-default">Tüm Ürünler</a></p>
                        </div>
                    </div>
                    <div class="display-table bottom-margin-default full-width">
                        <div
                            class="clearfix clear-padding list-logo-category list-logo-category-v1 float-left border no-border-t no-border-r">
                            <ul>
                                <li><a href="#"><img src="/frontend/img/logo_7.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_4.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_8.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_9.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_10.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_31.png" ></a></li>
                            </ul>
                        </div>
                        <div class=" banner-category float-left relative effect-bubba zoom-image-hover">
                            <img width="400" src="/frontend/img/banner_category_1-min.png">
                            <a href="#"></a>
                        </div>
                        <div class="clearfix list-products-category list-products-category-v1 float-left relative">
                            <div
                                class="box-mobile-content border-collapsed-box animate-default hidden-content-box active-box-category"
                                id="smart-phone">
                               @foreach($data['phone'] as $phone)
                                    <div
                                        class="clearfix relative product-no-ranking border-collapsed-element percent-content-2">
                                        <div class="effect-hover-zoom center-vertical-image">
                                            <img width="200" height="200" src="/images/products/{{$phone->photo}}">
                                            <a href="#"></a>
                                        </div>
                                        <div class="clearfix absolute name-product-no-ranking">
                                            <p class="title-product clearfix full-width title-hover-black"><a href="#">{{$phone->product_name}}</a></p>
                                            <p class="clearfix price-product"> {{$phone->product_price}} ₺ </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix relative full-width bottom-margin-default">
            <div class="clearfix container-web">
                <div class=" container banner_full_width">
                    <div class="row relative banners-effect5">
                        <img src="/frontend/img/banner_full_w_1.png"
                             class="img-responsive">
                        <a href="#"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Full With -->
        <!-- Product Box -->
        <div class=" container-web">
            <div class=" container">
                <div class="row">
                    <div class="clearfix title-box full-width border">
                        <div class="clearfix name-title-box title-category title-turquoise-bg relative">
                            <img  src="/frontend/img/icon_electric.png" class="absolute"/>
                            <p>Beyaz Eşya</p>
                        </div>
                        <div class="clearfix menu-title-box">
                            <p class="view-all-product-category title-hover-red"><a href="{{route('category.list',['slug'=>$data['category_slug'][4]])}}" class="animate-default">Tüm Ürünler</a></p>
                        </div>
                    </div>
                    <div class="display-table bottom-margin-default full-width">
                        <div
                            class="clearfix clear-padding list-logo-category border no-border-t no-border-r list-logo-category-v1 float-left">
                            <ul>
                                <li><a href="#"><img src="/frontend/img/logo_11.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_12.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_13.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_7.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_14.png" ></a></li>
                                <li><a href="#"><img src="/frontend/img/logo_15.png" ></a></li>
                            </ul>
                        </div>
                        <div class=" banner-category float-left relative zoom-image-hover effect-bubba">
                            <img src="/frontend/img/banner_category_1.png">
                            <a href="#"></a>
                        </div>
                        <div class="clearfix list-products-category list-products-category-v1 float-left relative">
                            <div
                                class="border-collapsed-box active-box-category hidden-content-box box-electric-content animate-default"
                                id="television">
                                @foreach($data['homep'] as $homep)
                                    <div
                                        class="clearfix relative product-no-ranking border-collapsed-element percent-content-2">
                                        <div class="effect-hover-zoom center-vertical-image">
                                            <img width="227" src="/images/products/{{$homep->photo}}">
                                            <a href=""></a>
                                        </div>
                                        <div class="clearfix absolute name-product-no-ranking">
                                            <p class="title-product clearfix full-width title-hover-black"><a href="#">{{$homep->product_name}}</a></p>
                                            <p class="clearfix price-product"> {{$homep->product_price}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" relative banner-half-web full-width bottom-margin-default">
            <div class="clearfix container-web">
                <div class=" container">
                    <div class="row">
                        <div
                            class="clearfix content-left col-md-6 col-sm-6 col-xs-12 zoom-image-hover overfollow-hidden">
                            <div class="overfollow-hidden effect-oscar relative">
                                <img class="max-width" src="/frontend/img/banner_halt.png" />
                                <a href="#"></a>
                            </div>
                        </div>
                        <div
                            class="clearfix content-right col-md-6 col-sm-6 col-xs-12 zoom-image-hover overfollow-hidden">
                            <div class="overfollow-hidden effect-oscar relative">
                                <img class="max-width" src="/frontend/img/banner_percent_2.png"/>
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
