@extends('Admin.layout')

@section('pagehead')
    Kategoriler
@endsection
@section('addnew')
    <div class="col-md-6 col-sm-12 text-right">
        <a href="{{route('admin.category.add')}}" class="btn btn-sm btn-primary" title="">Yeni Ekle</a>
    </div>
@endsection

@section('content')
    <head>
        <!-- Javascript -->

        <script src="/assets/bundles/libscripts.bundle.js"></script>
        <script src="/assets/bundles/vendorscripts.bundle.js"></script>
        <script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js">
            <script src="/assets/bundles/mainscripts.bundle.js"></script>
        <script src="/assets/vendor/dropify/js/dropify.min.js"></script>
        <script src="/assets/js/pages/forms/dropify.js"></script>
        <script src="/assets/js/alertify.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    </head>

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Aktif Kategoriler                 <small>Sürükle bırak ile sırasını ayarlayabilirsiniz</small>
                </h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table center-aligned-table">
                        <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>Düzenle</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($categories as $category)
                            <tr id="item-{{$category->id}}">
                                <td class="sortable">{{$category->category_name}}</td>

                                <td><a href="{{route('admin.category.edit',[$category->id])}}"
                                       class="btn btn-success btn-sm">Düzenle</a></td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');

                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('admin.category.sortable')}}",
                        success: function (msg) {
                            console.log(msg);
                            if (msg) {
                                alertify.success('İşlem Başarılı');
                            } else {
                                console.log(msg)
                                alertify.error('İşlem Başarısız');
                            }
                        }
                    });
                }
            });
            $('#sortable').disableSelection();
        });
    </script>

@endsection

