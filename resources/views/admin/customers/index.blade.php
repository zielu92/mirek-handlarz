@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>Klienci</h1>
        <div class="col-md-6 pull-left">
            <h4>Dodaj nowego klienta</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'AdminCustomerController@store', 'class'=>'form-row']) !!}

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
                {!! Form::submit('Dodaj', ['class'=>'btn btn-primary pull-right']) !!}
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
                    <th>Nazwa</th>
                    <th>Ilość zak. pojazdów</th>
                    <th>Ostatni zakup</th>
                </tr>
                </thead>
                <tbody>
                @if($customers)
                    @foreach($customers->sortByDesc('id') as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td><a href="{{route('admin.customer.show', $customer->id)}}">{{ $customer->name }}</a></td>
                            <td>{{$customer->car->count()}}</td>
                            <td>{{$customer->car->last() ? $customer->car->last()->sold_date : 'XXXX-XX-XX'}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
