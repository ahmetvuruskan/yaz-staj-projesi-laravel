@extends('Admin.layout')
@section('pagehead')
    {{$order->order_unique_id}}
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Sipariş Bilgileri</h2>
            </div>

            <div class="body">


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Ürün Adı</th>
                            <th>Net Ödenen Tutar</th>
                            <th>Adres</th>
                            <th>Kargo Durum</th>
                            <th>Sipariş Durum</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            <th scope="row">{{$order->order_unique_id}}</th>
                            <td>{{$order->product_name}}</td>
                            <td>{{$order->amount}} ₺</td>
                            <td>{{$order->shipping_adress}}</td>
                            <td>@if($order->order_status =='Yeni Sipariş')
                                    Henüz Kargoya Verilmedi
                                    <a href="{{route('createShipment',['id'=>$order->order_unique_id])}}"><button  class="btn btn-primary float-lg-right btn-xs" type="submit">Kargo Çıkışı Yap</button></a>

                                @else
                                    {{$order->shipment_track_id}}
                                @endif
                            </td>
                            <td>{{$order->order_status}} </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection


