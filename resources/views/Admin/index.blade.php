@extends('Admin.layout')
@section('pagehead')
    Anasayfa
@endsection

@section('content')

    <div class="col-12">

        <div class="card top_report">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-9 col-sm-7">
                    <div class="body">
                        <div class="clearfix">
                            <div class="float-md-left">
                                <i class="fa fa-2x fa-dollar text-col-blue"></i>
                            </div>
                            <div class="number float-right text-right">
                                <h6>Kazanç(₺)</h6>
                                <span style="font-size: 20px" class="font700">{{$count['sales']}}</span>
                            </div>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                            <div class="progress-bar" data-transitiongoal="100"></div>
                        </div>
                        <small class="text-muted"></small>
                    </div>
                </div>
                <div class="col-lg-4 col-md-9 col-sm-7">
                    <div class="body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="fa fa-2x fa-bar-chart-o text-col-green"></i>
                            </div>
                            <div class="number float-right text-right">
                                <h6>Toplam Sipariş</h6>
                                <span style="font-size: 20px" class="font700">{{$count['orders']}}</span>
                            </div>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                            <div class="progress-bar" data-transitiongoal="100"></div>
                        </div>
                        {{--                        <small class="text-muted">19% compared to last week</small>--}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-9 col-sm-7 ">
                    <div class="body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="fa fa-2x fa-shopping-cart text-col-red"></i>
                            </div>
                            <div class="number float-right text-right">
                                <h6>Tüm ürünler </h6>
                                <span style="font-size: 20px" class="font700">{{$count['product']}}</span>
                            </div>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                            <div class="progress-bar" data-transitiongoal="100"></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection
