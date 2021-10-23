@extends('Frontend.layout')
@section('title')
{{$data['singleProduct']->product_name}}
@endsection
@section('content')
<head>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

</head>
<div class="relative full-width">
    <div class="container-web relative">
        <div class="container">
            <div class="row">


            </div>
        </div>
    </div>
    <!-- Content Category -->
    <div class="relative container-web">
        <div class="container">
            <div class="row ">
                <!-- Content Category -->
                <div class="col-md-9 relative clear-padding">

                    <!-- Product Content Detail -->
                    <div class="top-product-detail relative ">
                        <div class="row">
                            <!-- Slide Product Detail -->
                            <div class="col-md-7 relative col-sm-12 col-xs-12">
                                <div id="owl-big-slide" class="relative sync-owl-big-image">
                                    <div class="item center-vertical-image">
                                        <img src="/images/products/{{$data['singleProduct']['photo']}}" >
                                    </div>


                                </div>
                            </div>
                            <!-- Info Top Product -->
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="name-ranking-product relative bottom-padding-15-default bottom-margin-15-default border no-border-r no-border-t no-border-l">
                                    <h1 class="name-product">{{$data['singleProduct']['product_name']}}</h1>
                                    <div class=" ranking-color ">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                    <p class="clearfix price-product">{{$data['singleProduct']['product_price']}}₺</p>
                                    <div class="product-code clearfix full-width">
                                        <p class="float-left relative">Ürün Id : {{$data['singleProduct']['product_id']}}</p>
                                        <p class="float-left clear-margin">Stok Durumu :
                                        @if($data['singleProduct']['product_quantity']>3)
                                                <span class="text-green">{{$data['singleProduct']['product_quantity']}}</span>
                                            @else
                                                <span class="text-red">{{$data['singleProduct']['product_quantity']}}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="relative option-product-detail bottom-padding-15-default border no-border-r no-border-t no-border-l">



                                </div>
                                <div class="relative button-product-list clearfix full-width clear-margin">
                                    <ul class="clear-margin top-margin-default clearfix bottom-margin-default">
                                        <li class="button-hover-red"><a href="{{route('shop.pay',['product_id'=>$data['singleProduct']['product_id']])}}" class="animate-default">Satın Al</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-product-detail bottom-margin-default relative">
                        <div class="row">
                            <div class="col-md-12 relative overfollow-hidden">
                                <ul class="title-tabs clearfix relative">
                                    <li  class="title-tabs-product-detail title-tabs-1 border no-border-b active-title-tabs bold uppercase">Ürün Detayları</li>
                                </ul>
                                <div class="content-tabs-product-detail relative content-tab-1 border active-tabs-product-detail bottom-padding-default top-padding-default left-padding-default right-padding-default">
                                  <p>{{$data['singleProduct']['product_description']}}</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="slide-product-bottom relative">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 relative bottom slide-related-product">
                                <p class="bold title-slide-product-bottom">BENZER ÜRÜNLER</p>
                                <div class="button-slide-related" id="btn-slide-1"></div>
                                <div class="owl-theme owl-carousel" data-items="1,2,3">
                                    @foreach($data['related'] as $related)
                                    <div class="items">
                                        <div class="full-width product-category relative">
                                            <div class="image-product  relative overfollow-hidden">
                                                <div class="center-vertical-image">
                                                    <img src="/images/products/{{$related->photo}}" alt="Product">
                                                </div>
                                                <a href="#"></a>
                                                <ul class="option-product animate-default">
                                                    <li class="relative"><a href="#"><i class="data-icon data-icon-ecommerce icon-ecommerce-bag"></i></a></li>
                                                    <li class="relative"><a href="#"><i class="data-icondata-icon-basic icon-basic-heart" aria-hidden="true"></i></a></li>
                                                    <li class="relative"><a href="javascript:;" ><i class="data-icon data-icon-basic icon-basic-magnifier" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                            <h3 class="title-product animate-default title-hover-black clearfix full-width"><a href="#">{{$related->product_name}}</a></h3>
                                            <p class="clearfix price-product">{{$related->product_price}}₺</p>

                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Product Content Category -->
                </div>
                <!-- Sider Bar -->
                <div class="col-md-3 relative left-padding-default clear-padding" id="slide-bar-category">
                    <div class="col-md-12 col-sm-12 col-xs-12 sider-bar-category border bottom-margin-default">
                        <p class="title-siderbar bold">Kategoriler</p>
                        <ul class="clear-margin list-siderbar">
                            @foreach($data['category'] as $category)
                                <li><a href="{{route('category.list',['slug'=>$category->category_slug])}}">{{$category->category_name}}</a></li>
                                
                            @endforeach
                        </ul>
                    </div>
                    <!-- Element Best Sellers -->
                    <div class="col-sm-12 col-sm-12 col-xs-12 sider-bar-category border bottom-margin-default">
                        <p class="title-siderbar bold bottom-margin-15-default">Son Kalanlar</p>
                        @foreach($data['lasts'] as $last)
                        <div class="clearfix relative best-sellers-product">
                            <div class="image-product-sellers-sidebar float-left">
                                <a href="{{route('urun.detay',['slug'=>$last->product_slug])}}"><img width="265" src="/images/products/{{$last->photo}}" alt="" /></a>
                            </div>
                            <div class="info-product-sellers-sidebar float-left">
                                <p class="title-product-sellers-sidebar title-hover-black"><a class="animate-default" href="#">{{$last->product_name}}</a></p>

                                <p class="clearfix price-product">{{$last->product_price}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- End Element Best Sale -->


                </div>

            </div>
        </div>
    </div>


</div>

@endsection
