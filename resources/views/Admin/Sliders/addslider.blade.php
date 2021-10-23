@extends('Admin.layout')

@section('pagehead')
    Yeni Slider Ekle
@endsection


@section('content')
    <head>


        <script src="/assets/vendor/jquery/jquery.js"></script>
        <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
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
                      action="{{route('admin.slider.save')}}">
                    @csrf
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                           <ul>
                               <li class="alert alert-danger" >{{$error}} </li>
                           </ul>
                        @endforeach
                    @endif

                    <div class="form-group">
                        <label> Slider Başlık. </label>
                        <input type="text" name="slider_header" value="{{old('slider_header')}}" required class="form-control">
                    </div>


                    <div class="form-group">
                        <label> Slider Açıklama </label>
                        <input type="text" value="{{old('slider_description')}}" class="form-control" name="slider_description">
                    </div>
                    <div class="form-group">
                        <label> Slider Url </label>
                        <input type="url" required value="{{old('slider_url')}}" class="form-control" name="slider_url">
                    </div>
                    <div class="form-group">
                        <label> Slider Sıra </label>
                        <input type="number" required value="{{old('slider_must')}}" class="form-control" name="slider_must">
                    </div>
                    <div class="form-group">
                        <label>Slider Resim <small>Görsel 1600x688 boyutunda olmalıdır.</small> </label>
                        <input class="form-control dropify" required accept="image/png, image/gif, image/jpeg" type="file"
                               name="slider_image">
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>

            </div>
        </div>
    </div>



@endsection
