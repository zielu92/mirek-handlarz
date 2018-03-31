@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>Kierowcy</h1>
        <div class="col-md-6 pull-left">
            <h4>Edytuj kierowce {{$driver->name}}</h4>
            {!! Form::model($driver,['method'=>'PATCH', 'action'=>['AdminDriverController@update', $driver->id], 'class'=>'form-row']) !!}

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
            <h4>Przeglądaj ostatnie transporty kierowcy</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Typ</th>
                    <th>Rejestracja</th>
                    <th>Data</th>
                    <th>Akcja</th>
                </tr>
                </thead>
                <tbody>
                @if($transports)
                    @foreach($transports->sortByDesc('id') as $transport)
                        <tr>
                            <td>{{ $transport->id }}</td>
                            <td>@if($transport->type ==1)
                                    <i class="fa fa-lg fa-arrow-left badge-success rounded" title="przywóz">
                                        @else
                                            <i class="fa fa-lg fa-arrow-right badge-danger rounded" title="wywóz">
                                @endif
                            </td>
                            <td>{{$transport->plates}}</td>
                            <td>{{$transport->transport_date}}</td>
                            <td><a href="{{route('admin.transport.show', $transport->id)}}">Szczegóły transportu</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{$transports->render()}}
        </div>
    </div>

@endsection
