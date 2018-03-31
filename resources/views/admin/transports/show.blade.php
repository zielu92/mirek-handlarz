@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>Transport #{{$transport->id}} {{$transport->plates}}</h1>
        <div class="col-md-4 pull-left">
            <h4>Informacje o transporcie</h4>
            <ul>
                <li>Data transportu: {{$transport->transport_date}}</li>
                <li>Kierowca {{$transport->driver->name}}
                    @if($transport->driver->company)dla firmy {{$transport->driver->company}} @endif
                </li>
                <li>Typ: {{$transport->type==1 ? 'przywóz' : 'wywóz'}}</li>
                <li>Uwagi: {{$transport->extra ? $transport->extra : 'brak'}}</li>
            </ul>

        </div>

        <div class="col-md-8 pull-right">
            <h4>Przeglądaj transport</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Pojazd</th>
                    <th>Cena sprzedaży</th>
                    <th>Data zakupu</th>
                    <th>Klient</th>
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
                            <td>{{$car->sold_price}}</td>
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
