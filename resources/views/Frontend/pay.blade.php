@extends('Frontend.layout')

@section('title')
    Ödeme Yap
@endsection
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        body {
            margin-top: 20px;
        }

        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .checkbox.pull-right {
            margin: 0;
        }

        .pl-ziro {
            padding-left: 0px;
        }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
@section('content')

    <!-- Content Box -->
    <div class="relative full-width">
        <!-- Breadcrumb -->
        <div class="container-web relative">
            <div class="container">
                <div class="row">
                    <div class="breadcrumb-web">

                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Content Checkout -->
        <div class="relative container-web">
            <div class="container">

                <form action="{{route('virtualTerminal')}} " method="post">
                    @csrf
                    <div class="col-md-8 col-sm-12 col-xs-12 relative left-content-shoping clear-padding-left">
                        <p class="title-shoping-cart">Fatura Detayları</p>
                        <div class="relative clearfix full-width">
                            <div
                                class="col-md-6 col-sm-6 col-xs-12 clearfix clear-padding-left clear-padding-480 relative form-input">
                                <label> İsim *</label>
                                <input autofocus class="full-width" type="text" name="firstname">
                            </div>
                            <div
                                class="col-md-6 col-sm-6 col-xs-12 clearfix clear-padding-right clear-padding-480 relative form-input">
                                <label>Soyisim *</label>
                                <input class="full-width" type="text" name="lastname">
                            </div>
                        </div>
                        @if($data['product']->product_price >=150)
                            <input type="text" hidden name="price" value="{{$data['product']['product_price']}}" >
                        @else
                            <input type="text" hidden name="price" value="{{intval($data['product']['product_price'])+intval($shipment)}}" >
                            @endif
                        <input type="text" hidden name="product_id" value="{{$data['product']->product_id}}" >

                        <input type="text" hidden name="category_id" value="{{$data['product']->product_category}}" >
                        <input type="text" hidden name="product_name" value="{{$data['product']->product_name}}" >
                        <div class="relative clearfix full-width">
                            <div
                                class="col-md-6 col-sm-6 col-xs-12 clearfix clear-padding-left clear-padding-480 relative form-input">
                                <label>Mail Adresi *</label>
                                <input class="full-width" type="text" name="email">
                            </div>
                            <div
                                class="col-md-6 col-sm-6 col-xs-12 clearfix clear-padding-right clear-padding-480 relative form-input">
                                <label>Cep Telefonu *</label>
                                <input class="full-width"  type="text" name="phone">
                            </div>
                        </div>
                        <div class="relative clearfix full-width">
                            <div
                                class="col-md-6 col-sm-6 col-xs-12 clearfix clear-padding-left clear-padding-480 relative form-input">
                                <label>İl </label>
                                <select name="il" id="il" class="full-width">
                                    <option selected value="Seçin">Seçin...</option>
                                </select>
                            </div>
                            <div
                                class="col-md-6 col-sm-6 col-xs-12 clearfix clear-padding-right clear-padding-480 relative form-input">
                                <label>İlçe</label>
                                <select name="ilce" id="ilce" class="full-width" disabled="disabled">
                                    <option  value="">Seçin...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-input full-width clearfix relative">
                            <label>Adres *</label>
                            <input class="full-width" type="text" name="address">
                        </div>
                        <div class="form-input full-width clearfix relative">
                            <label>TC kimlik numarası * <small>Tc vatandaşı değilseniz boş bırakınız.</small></label>
                            <input class="full-width" type="text" name="ıdentity_number">
                        </div>


                        <p class="title-shoping-cart">Ödeme Detayları </p>

                        <div class="form-input clearfix full-width relative">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        <div class="panel panel-default">

                                            <div class="panel-body">

                                                <div class="form-group">
                                                    <label for="cardNumber">
                                                        Kart Numarası </label>
                                                    <div class="input-group">
                                                        <input type="number" name="card_number" class="form-control"
                                                               id="cardNumber" value="5400360000000003"  placeholder="Kart Numaranız"
                                                               required />
                                                        <span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-lock"></span></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cardNumber">
                                                        Kart Sahibi </label>
                                                    <div class="input-group">
                                                        <input type="text" name="card_holder" class="form-control"
                                                             placeholder="Kart Sahibi"
                                                               required />
                                                        <span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-user"></span></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-7 col-md-7">
                                                        <div class="form-group">
                                                            <label for="expityMonth">
                                                                Son Kullanma Tarihi</label>
                                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                <input type="number" name="expiry_month"
                                                                       class="form-control" id="expityMonth"
                                                                       placeholder="AA"  min="1" max="12" required/>
                                                            </div>
                                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                <input type="number" name="expiry_year"
                                                                       class="form-control" id="expityYear"
                                                                       placeholder="YY"  min="1" max="50" required/></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5 col-md-5 pull-right">
                                                        <div class="form-group">
                                                            <label for="cvCode">
                                                                CV CODE</label>
                                                            <input type="password" maxlength="3" name="cvv_code" class="form-control"
                                                                   id="cvCode" placeholder="CVV" required/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12 right-content-shoping relative clear-padding-right">
                        <p class="title-shoping-cart">Siparişiniz</p>
                        <div class="full-width relative overfollow-hidden">
                            <div
                                class="relative clearfix full-width product-order-sidebar border no-border-t no-border-r no-border-l">
                                <div class="image-product-order-sidebar center-vertical-image">
                                    <img width="265" src="/images/products/{{$data['product']->photo}}" alt=""/>
                                </div>
                                <div class="relative info-product-order-sidebar">
                                    <p class="title-product top-margin-15-default animate-default title-hover-black"><a
                                            href="#">{{$data['product']->product_name}}</a></p>
                                    <p class="price-product">{{$data['product']->product_price}} ₺</p>
                                </div>
                            </div>

                        </div>
                        <p class="title-shoping-cart">Toplam</p>
                        <div class="full-width relative cart-total bg-gray  clearfix">
                            <div
                                class="relative justify-content bottom-padding-15-default border no-border-t no-border-r no-border-l">
                                <p>Ara Toplam</p>
                                <p class="text-red price-shoping-cart">{{$data['product']->product_price}}₺</p>
                            </div>
                            <div
                                class="relative border top-margin-15-default bottom-padding-15-default no-border-t no-border-r no-border-l">
                                <p class="bottom-margin-15-default">Kargo</p>
                                <div class="relative justify-content">
                                    <ul class="check-box-custom title-check-box-black clear-margin clear-margin">
                                        <li>
                                            <label>Ücretsiz Kargo
                                                <input type="radio"
                                                       @if($data['product']->product_price>=150)
                                                       checked
                                                       @endif
                                                       name="shiping-order" disabled>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>Standard
                                                <input
                                                    @if($data['product']->product_price<150)
                                                    checked
                                                    @endif
                                                    type="radio" disabled name="shiping-order">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>

                                    </ul>
                                    <p class="price-gray-sidebar">{{$shipment}} ₺</p>
                                </div>

                            </div>
                            <div class="relative justify-content top-margin-15-default">
                                <p class="bold">Total</p>
                                <p class="text-red price-shoping-cart">
                                    @if($data['product']->product_price >= 150)

                                        {{$data['product']->product_price}}
                                    @else
                                        {{intval($data['product']['product_price'])+intval($shipment)}}
                                    @endif

                                </p>
                            </div>
                        </div>
                        <div class="full-width relative payment-box bg-gray top-margin-15-default clearfix">
                            <ul class="check-box-custom list-radius title-check-box-black clear-margin clear-margin">
                                <li>
                                    <label class="">Kredi Kartı
                                        <input type="radio" name="payment" checked="">
                                        <span class="checkmark"></span>
                                    </label>
                                    <br>
                                    <p class="info-payment">Tüm kredi ve banka kartları geçerilidir</p>
                                </li>
                            </ul>
                        </div>
                        <input type="submit" value="Güvenli Ödeme"
                               class="btn-proceed-checkout full-width top-margin-15-default">

                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $.getJSON("/il-bolge.json", function(sonuc){
            $.each(sonuc, function(index, value){
                var row="";
                row +='<option value="'+value.il+'">'+value.il+'</option>';
                $("#il").append(row);
            })
        });

        $("#il").on("change", function(){
            var il=$(this).val();
            $("#ilce").attr("disabled", false).html("<option value=''>Seçin..</option>");
            $.getJSON("/il-ilce.json", function(sonuc){
                $.each(sonuc, function(index, value){
                    var row="";
                    if(value.il==il)
                    {
                        row +='<option value="'+value.ilce+'">'+value.ilce+'</option>';
                        $("#ilce").append(row);
                    }
                });
            });
        });
    </script>


@endsection
