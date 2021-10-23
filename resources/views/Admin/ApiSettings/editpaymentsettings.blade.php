@extends('Admin.layout')
@section('pagehead')
   Sanal Pos Düzenle
@endsection
@section('content')
    <head>
        <link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
        <script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
        <script src="/assets/vendor/jquery/jquery.js"></script>
        <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="/assets/vendor/dropify/js/dropify.min.js"></script>
        <script src="/assets/js/pages/forms/dropify.js"></script>

    </head>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Sanal Pos Ayarları</h2>
            </div>

            <div class="body">
                <form id="basic-form"  method="post"
                      action="{{route('admin.settings.update',['id'=>$data[0]->id])}}"
                      novalidate>
                    @csrf
                    <div class="form-group">
                        <label> Değer 1  </label>
                        <input  type="text" name="value1" class="form-control" value="{{$data[0]->value_1}}">

                    </div>
                    <div class="form-group">
                        <label> Değer 2  </label>
                        <input type="text" name="value2" class="form-control" value="{{$data[0]->value_2}}">
                    </div>
                    <br>
                    <input hidden name="paymetSettings" type="checkbox" checked>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>


@endsection
