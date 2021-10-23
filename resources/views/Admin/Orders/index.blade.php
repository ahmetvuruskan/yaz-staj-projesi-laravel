@extends('Admin.layout')

@section('pagehead')
   Siparişler
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
    </head>

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
                            <th>Sipariş Id</th>
                            <th>Sipariş Tarihi</th>
                            <th>Sipariş Durumu</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            <tr>
                                <td>{{$order->order_unique_id}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->order_status}}</td>
                                <td><a href="{{route('admin.orders.edit',['id'=>$order->order_unique_id])}}" class="btn btn-success btn-sm">Sipariş Detay</a></td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

