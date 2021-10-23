@extends('Admin.layout')

@section('pagehead')
    Ürün Düzenle
@endsection



@section('content')
    <head>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <script src="/assets/vendor/jquery/jquery.js"></script>

        <link rel="stylesheet" href="/assets/vendor/dropify/css/dropify.min.css">
        <script src="/assets/vendor/dropify/js/dropify.min.js"></script>
        <script src="/assets/js/pages/forms/dropify.js"></script>
    </head>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@yield('pagehead')</h2>
            </div>
            <div class="body">
                <form id="basic-form" enctype="multipart/form-data" method="post"
                      action="{{route('admin.product.update',[$data['singleProduct']['id']])}}">
                    @csrf
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                           <ul>
                               <li class="alert alert-danger" >{{$error}} </li>
                           </ul>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label> Ürün ID <small>(Bu id otomatik atanır ve değiştirilemez)</small> </label>
                        <input type="text"  name="product_unique_id" value="{{$data['singleProduct']['product_id']}}"
                               class="form-control"
                               readonly>
                    </div>
                    <div class="form-group">
                        <label> Ürün Adı </label>
                        <input type="text" name="product_name" value="{{$data['singleProduct']['product_name']}}" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label> Ürün Kategorisi </label>
                        <select class="form-control " required name="product_category">
{{--                            foreach ile gönderdiğimiz kategori verisini selecte ekliyoruz.--}}
{{--                            koşul ifadesinde gelen ürün bilgisi ile kategori idsi aynı ise seçili olarak gelmesini sağlıyoruz.--}}
                            @foreach($data['categories'] as $category)
                                <option @if($data['singleProduct']['product_category']==$category->id)
                                        selected
                                        @endif
                                        value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                    </div>


                    <div class="form-group">
                        <label> Stok Adeti </label>
                        <input type="number" value="{{$data['singleProduct']['product_quantity']}}" class="form-control" name="product_quantity">
                    </div>
                    <div class="form-group">
                        <label> Ürün Fiyatı </label>
                        <input type="number" required value="{{$data['singleProduct']['product_price']}}" class="form-control" name="product_price">
                    </div>
                    <div class="form-group">
                        <label>Ürün Açıklaması</label>
                        <textarea class="form-control"   required name="product_detail">{{$data['singleProduct']['product_detail']}}</textarea>
                        <script>
                            CKEDITOR.replace('product_detail');
                        </script>
                    </div>
                    <div class="form-group " >
                        <img width="150" class="border" src="/images/products/{{$data['showCase']['photo']}}" alt="">

                    </div>

                    <div class="form-group">
                        <label>Vitrin Görseli </label>
                        <input type="hidden" value="{{$data['showCase']['photo']}}" name="old_showcase" >
                <input class="form-control dropify"  accept="image/png, image/gif, image/jpeg" type="file"
                               name="product_showcase">
                    </div>



                    <br>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>

            </div>
        </div>
    </div>
  



@endsection
