@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>Kierowcy</h1>
        <div class="col-md-6 pull-left">
            <h4>Dodaj nowego kierowce</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'AdminDriverController@store', 'class'=>'form-row']) !!}

            <div class="form-group col-md-6">
                {!! Form::label('name', 'Nazwa') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('phone', 'Telefon') !!}
                {!! Form::text('phone', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('company', 'Firma') !!}
                {!! Form::text('company', null, ['class'=>'form-control']) !!}
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
                    <th>Firma</th>
                    <th>Ilość transportów</th>
                </tr>
                </thead>
                <tbody>
                @if($drivers)
                    @foreach($drivers->sortByDesc('id') as $driver)
                        <tr>
                            <td>{{ $driver->id }}</td>
                            <td><a href="{{route('admin.drivers.edit',$driver->id)}}">{{$driver->name}}</a></td>
                            <td>{{$driver->company}}</td>
                            <td>{{$driver->transport ? $driver->transport->count() : 0 }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
