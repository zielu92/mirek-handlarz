@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>Klient #{{$customer->id}} {{$customer->name}}</h1>
        <div class="col-md-6 pull-left">
            <h4>Edytuj klienta</h4>
            {!! Form::model($customer, ['method'=>'PATCH', 'action'=>['AdminCustomerController@update', $customer->id],
             'class'=>'form-row']) !!}

            <div class="form-group col-md-6">
                {!! Form::label('name', 'Nazwa') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('phone', 'Telefon') !!}
                {!! Form::text('phone', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('address', 'Adres') !!}
                {!! Form::textarea('address', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('extra', 'Uwagi') !!}
                {!! Form::textarea('extra', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-grop col-md-12">
                {!! Form::submit('Edytuj', ['class'=>'btn btn-primary pull-right']) !!}
            </div>

            {!! Form::close() !!}

            @include('includes.formError')

        </div>
        <div class="col-md-6 pull-right">
            <h4>Przeglądaj</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Pojazd</th>
                    <th>Cena sprzedaży</th>
                    <th>Zysk</th>
                    <th>Data zakupu</th>
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
                            <td>{{$customer->profit($car->bought_price,$car->sold_price)}}</td>
                            <td>{{$car->sold_date}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
