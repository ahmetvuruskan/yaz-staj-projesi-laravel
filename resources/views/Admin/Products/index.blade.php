@extends('Admin.layout')
@section('pagehead')
    Ürünler
@endsection
@section('addnew')
    <div class="col-md-6 col-sm-12 text-right">
        <a href="{{route('admin.product.add')}}" class="btn btn-sm btn-primary" title="">Yeni Ekle</a>
    </div>
@endsection

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Aktif Ürünler</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table center-aligned-table">
                        <thead>
                        <tr>
                            <th>Ürün Adı</th>
                            <th>Ürün Vitrin</th>
                            <th>Ürün Adet</th>
                            <th>Ürün Fiyat</th>
                            <th></th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr id="item-{{$product->product_id}}">
                                <td>{{$product->product_name}}</td>
                                <td>Ürün Vitrin Görseli</td>
                                <td>{{$product->product_quantity}}</td>
                                <td>{{$product->product_price}}₺</td>
                                <td><a href="{{route('admin.product.edit',[$product->id])}}"
                                       class="btn btn-success btn-sm">Düzenle</a></td>
                                <td><a href="javascript:void(0)" id="{{$product->product_id}}" class="btn btn-danger btn-sm">Sil</a></td>
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
        });

        $(".btn-danger").click(function () {
            destroy_id = $(this).attr('id');
            alertify.confirm('Silme işlemini onaylayın', 'Bu işlem geri alınamaz',


                function () {
                    $.ajax({
                        type: "DELETE",
                        url: "urunler/urunsil/" + destroy_id,
                        success: function (msg) {
                            if (msg) {
                                $("#item-" + destroy_id).remove();
                                alertify.success("Silme işlemi başarılı")
                            } else {
                                alertify.error("İşlem tamamlanamadı")
                            }
                        }
                    });
                }

                ,

                function () {
                    alertify.error('Silme işlemi iptal edildi');
                }

            ).set('labels',{ok:'SIL',cancel:'VAZGEÇ'});
        });

    </script>

@endsection
