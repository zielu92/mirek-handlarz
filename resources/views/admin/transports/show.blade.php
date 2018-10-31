@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::choice('admin/transports.transports',1)}} #{{$transport->id}} {{$transport->plates}}</h1>
        <div class="col-md-4 pull-left">
            <h4>{{Lang::get('admin/transports.infoTransport')}}</h4>
            <ul>
                <li>{{Lang::get('admin/transports.date')}}: {{$transport->transport_date}}</li>
                <li>{{Lang::get('admin/transports.driver')}} {{$transport->driver->name}}
                    @if($transport->driver->company)dla firmy {{$transport->driver->company}} @endif
                </li>
                <li>{{Lang::get('admin/transports.type')}}:
                    {{$transport->type==1 ? Lang::get('admin/transports.typeIn') : Lang::get('admin/transports.typeOut')}}
                </li>
                <li>{{Lang::get('admin/transports.comment')}}:
                    {{$transport->extra ? $transport->extra : Lang::get('admin/transports.none')}}
                </li>
            </ul>

        </div>

        <div class="col-md-8 pull-right">
            <h4>{{Lang::get('admin/transports.browse')}}</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{Lang::get('admin/transports.id')}}</th>
                    <th>{{Lang::get('admin/transports.vehicle')}}</th>
                    <th>{{Lang::get('admin/transports.sellPrice')}}</th>
                    <th>{{Lang::get('admin/transports.boughtDate')}}</th>
                    <th>{{Lang::get('admin/transports.customer')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($cars)
                    @foreach($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td><a href="{{route('admin.cars.show', $car->id)}}">
                                    @if($car->model)
                                        <b>{{$car->model->brand->name}}</b> {{$car->model->model}}
                                    @endif
                                </a>
                            </td>
                            <td>{{$car->sold_price}} {{$car->sold_currency}}</td>
                            <td>{{$car->bought_date}}</td>
                            <td>@if($car->customer)
                                <a href="{{route('admin.customer.show',$car->customer->id)}}">{{$car->customer->name}}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
