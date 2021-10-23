@extends('Admin.layout')

@section('pagehead')
    Sayfa Ekle
@endsection



@section('content')
    <head>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
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
                      action="{{route('admin.pages.update',['id'=>$pages->id])}}">
                    @csrf
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                           <ul>
                               <li class="alert alert-danger" >{{$error}} </li>
                           </ul>
                        @endforeach
                    @endif

                    <div class="form-group">
                        <label> Sayfa Adı </label>
                        <input type="text" name="page_head" value="{{$pages->page_head}}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Sayfa İçeriği</label>
                        <textarea class="form-control"   name="page_content">{!! $pages->page_content !!}</textarea>
                        <script>
                            CKEDITOR.replace('page_content');
                        </script>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>

            </div>
        </div>
    </div>



@endsection
