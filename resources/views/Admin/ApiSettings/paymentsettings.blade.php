@extends('Admin.layout')
@section('pagehead')
   Sanal Pos Ayarları
@endsection
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Ayarlar</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table center-aligned-table">
                        <thead>
                        <tr>
                            <th>Ayar Adı</th>
                          <th> Düzenle</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $paymentSetting)
                            <tr>
                                <td>{{$paymentSetting->api_name}}</td>


                                <td><a href="{{route('admin.settings.payment.edit',['id'=>$paymentSetting->id])}}" class="btn btn-success btn-sm">Düzenle</a></td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
