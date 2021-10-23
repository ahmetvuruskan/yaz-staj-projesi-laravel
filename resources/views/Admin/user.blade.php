@extends('Admin.layout')
@section('pagehead')
    Profilim
@endsection

@section('content')
    <head>
        <head>

            <script src="/assets/vendor/jquery/jquery.js"></script>
            <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
            <script src="/assets/vendor/dropify/js/dropify.min.js"></script>
            <script src="/assets/js/pages/forms/dropify.js"></script>
        </head>
    </head>
    <div class="col-lg-4 col-md-12">
        <div class="card profile-header">
            <div class="body text-center">
                <div class="profile-image mb-3"><img src="/images/users/{{\Illuminate\Support\Facades\Auth::user()->user_photo}}" class="rounded-circle" alt=""></div>
                <div>
                    <h4 class="mb-0"><strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong></h4>
                </div>

            </div>
        </div>


    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="body">
                <ul class="nav nav-tabs-new">

                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Settings">Hesap Bilgileri</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-content padding-0">

            <div class="tab-pane active " id="Settings">


                <div class="card">
                    <div class="header bline">
                        <h2>Hesap Bilgileri</h2>

                    </div>
                    <br>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <ul>
                                <li class="alert alert-danger">{{$error}} </li>
                            </ul>
                        @endforeach
                    @endif
                    <form action="{{route('admin.user.update',[\Illuminate\Support\Facades\Auth::user()->id])}}"
                          method="post">
                        @csrf
                        <div class="body">
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                               value="{{\Illuminate\Support\Facades\Auth::user()->email}}" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <h6>Şifre Değiştir</h6>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Yeni şifre">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="Yeni şifre tekrar">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="current_password" class="form-control"
                                               placeholder="Mevcut Şifre">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Güncelle</button> &nbsp;&nbsp;
                        </div>
                    </form>
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.user.update',[\Illuminate\Support\Facades\Auth::id()])}}">
                        @csrf
                        <div class="body">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::user()->user_photo}}" name="old_file">
                                    <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control dropify" name="user_photo">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Güncelle</button> &nbsp;&nbsp;
                        </div>
                    </form>
                </div>
            </div>

        </div>


@endsection
