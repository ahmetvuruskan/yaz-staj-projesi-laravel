@extends('Admin.layout')
@section('pagehead')
    Ayarlar
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
                            <th>Ayar</th>
                            <th>Değer</th>
                            <th>Tip</th>
                            <th>Düzenle</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <td>{{$setting->settings_description}}</td>
                                <td>@if($setting->settings_type =='file')
                                        <img width="100" src="/images/settings/{{$setting->settings_value}}" >
                                    @else
                                        {{$setting->settings_value}}
                                    @endif

                                </td>
                                <td>{{$setting->settings_type}}</td>
                                <td><a href="{{route('admin.settings.edit',[$setting->id])}}" class="btn btn-success btn-sm">Düzenle</a></td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
