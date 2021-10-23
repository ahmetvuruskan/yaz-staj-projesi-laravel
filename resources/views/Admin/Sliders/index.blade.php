@extends('Admin.layout')
@section('pagehead')
   Yüklü Sliderler
@endsection
@section('addnew')
    <div class="col-md-6 col-sm-12 text-right">
        <a href="{{route('admin.slider.add')}}" class="btn btn-sm btn-primary" title="">Yeni Ekle</a>
    </div>
@endsection

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@yield('pagehead')</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table center-aligned-table">
                        <thead>
                        <tr>
                            <th>Slider Resim</th>
                            <th></th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr id="item-{{$slider->id}}">
                                <td><img width="150" src="/images/sliders/{{$slider->slider_photo}}" ></td>
                                <td><a href="{{route('admin.slider.edit',[$slider->id])}}"
                                       class="btn btn-success btn-sm">Düzenle</a></td>
                                <td><a href="javascript:void(0)" id="{{$slider->id}}" class="btn btn-danger btn-sm">Sil</a></td>
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
                        url: "slider/sil/" + destroy_id,
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
