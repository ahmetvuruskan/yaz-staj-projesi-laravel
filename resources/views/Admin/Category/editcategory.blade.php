@extends('Admin.layout')

@section('pagehead')
    Kategori Düzenle
@endsection



@section('content')
    <head>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="/assets/vendor/jquery/jquery.js"></script>
        <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    </head>

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@yield('pagehead')</h2>
            </div>
            <div class="body">
                <form id="basic-form" enctype="multipart/form-data" method="post"
                      action="{{route('admin.category.update',[$categories['single']['id']])}}">
                    @csrf
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                           <ul>
                               <li class="alert alert-danger" >{{$error}} </li>
                           </ul>
                        @endforeach
                    @endif

                    <div class="form-group">
                        <label> Kategori Adı </label>
                        <input type="text" name="category_name" value="{{$categories['single']['category_name']}}" required class="form-control">
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>

            </div>
        </div>
    </div>



@endsection
