@extends('Admin.layout')
@section('pagehead')
    Ayarları düzenle
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
                <h2>Ayar: {{$singleSetting->settings_description}}</h2>
            </div>
            <div class="body">
                <form id="basic-form" enctype="multipart/form-data" method="post"
                      action="{{route('admin.settings.update',[$singleSetting->id])}}"
                      novalidate>
                    @csrf
                    <div class="form-group">
                        <label> Ayar Adı </label>
                        <input type="text" class="form-control" value="{{$singleSetting->settings_description}}"
                               disabled>
                    </div>
                    @if($singleSetting['settings_type'] =='file')
                        <div class="form-group">
                            <label> Yüklü Resim </label>
                            <br>
                            <img width="150" src="/images/settings/{{$singleSetting->settings_value}}" alt="">
                        </div>
                    @endif
                    <div class="form-group">
                        <label> Değer </label>
                        @if($singleSetting['settings_type']=='tag')
                            <input type="text" class="form-control" name="settings_value" data-role="tagsinput"
                                   value="{{$singleSetting->settings_value}}">
                        @elseif($singleSetting['settings_type'] =='file')

                            <input type="hidden" name="old_file" value="{{$singleSetting->settings_value}}">
                            <div class="body">
                                <input name="settings_value" type="file" class="dropify">

                            </div>
                        @else
                            <input type="text" name="settings_value" class="form-control"
                                   value="{{$singleSetting->settings_value}}">
                        @endif

                    </div>
                    <div class="input-group demo-tagsinput-area">

                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>


@endsection
