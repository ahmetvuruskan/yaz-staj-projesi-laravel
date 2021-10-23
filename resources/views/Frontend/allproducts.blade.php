@extends('Frontend.layout')
@section('title')
    {{$data['activeCategory'][0]['category_name']}}
@endsection
@section('content')
    <div class="relative full-width">
        <!-- Breadcrumb -->
        <div class="container-web relative">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Content Category -->
        <div class="relative container-web">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 relative overfollow-hidden clear-padding button-show-sidebar">

                    </div>
                    <div
                        class="banner-top-category-page bottom-margin-default effect-bubba zoom-image-hover overfollow-hidden relative full-width">

                        <a href="#"></a>
                    </div>
                </div>
                <div class="row ">
                    <!-- Content Category -->
                    <div class="col-md-9 relative clear-padding">

                        <div class="bar-category bottom-margin-default border no-border-r no-border-l no-border-t">
                            <div class="row">
                                <div class="col-md-5 col-sm-5 col-xs-4">
                                    <p class="title-category-page clear-margin">{{$data['activeCategory'][0]['category_name']}}</p>
                                </div>

                            </div>
                        </div>
                        <!-- Product Content Category -->
                        <div class="row">
                            @foreach($data['allprods'] as $prod)
                            <div
                                class="col-md-4 col-sm-4 col-xs-12 product-category relative effect-hover-boxshadow animate-default">
                                <div class="image-product relative overfollow-hidden">
                                    <div class="center-vertical-image">
                                        <a href="{{route('urun.detay',['slug'=>$prod->product_slug])}}">  <img width="265" src="/images/products/{{$prod->photo}}" alt="{{$prod->product_slug}}"></a>
                                    </div>


                                </div>
                                <h3 class="title-product clearfix full-width title-hover-black"><a href="{{route('urun.detay',['slug'=>$prod->product_slug])}}">{{$prod->product_name}}</a></h3>
                                <p class="clearfix price-product">{{$prod->product_price}}₺</p>
                                <div class="clearfix ranking-product-category ranking-color">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                            </div>
                            @endforeach


                        </div>
                        <div class="row">
                            <div class="pagging relative">
                                <ul>
                                    {!! $data['allprods']->links() !!}
                                </ul>
                            </div>
                        </div>
                        <!-- End Product Content Category -->
                    </div>
                    <!-- Sider Bar -->
                    <div class="col-md-3 relative left-padding-default clear-padding" id="slide-bar-category">
                        <div class="col-md-12 col-sm-12 col-xs-12 sider-bar-category border bottom-margin-default">
                            <p class="title-siderbar bold">KATEGORİLER</p>
                            <ul class="clear-margin list-siderbar">
                                @foreach($data['categories'] as $category)
                                <li><a href="{{route('category.list',['slug'=>$category->category_slug])}}">{{$category->category_name}}</a></li>
                            @endforeach
                            </ul>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    </div>
@endsection
