@extends('Admin.layout')

@section('pagehead')
    Yeni Ürün Ekle
@endsection



@section('content')
    <head>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <script src="/assets/vendor/jquery/jquery.js"></script>
        <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="/assets/vendor/dropify/js/dropify.min.js"></script>
        <script src="/assets/js/pages/forms/dropify.js"></script>
    </head>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Yeni Ürün Ekle</h2>
            </div>
            <div class="body">
                <form id="basic-form" enctype="multipart/form-data" method="post"
                      action="{{route('admin.product.save')}}">
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
                        <input type="text"  name="product_unique_id" value="{{uniqid('PRD-')}}"
                               class="form-control"
                               readonly>
                    </div>
                    <div class="form-group">
                        <label> Ürün Adı </label>
                        <input type="text" name="product_name" value="{{old('product_name')}}" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label> Ürün Kategorisi </label>
                        <select class="form-control " required name="product_category">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach

                        </select>

                    </div>


                    <div class="form-group">
                        <label> Stok Adedi </label>
                        <input type="number" value="{{old('product_quantity')}}" class="form-control" name="product_quantity">
                    </div>
                    <div class="form-group">
                        <label> Ürün Fiyatı </label>
                        <input type="number" required value="{{old('product_price')}}" class="form-control" name="product_price">
                    </div>
                    <div class="form-group">
                        <label>Ürün Açıklaması</label>
                        <textarea class="form-control"   required name="product_detail"> {{old('product_detail')}}</textarea>
                        <script>
                            CKEDITOR.replace('product_detail');
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Vitrin Görseli </label>
                        <input class="form-control dropify" required accept="image/png, image/gif, image/jpeg" type="file"
                               name="product_showcase">
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>

            </div>
        </div>
    </div>



@endsection
