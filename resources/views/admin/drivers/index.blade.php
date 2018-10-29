@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::choice('admin/drivers.drivers', 2)}}</h1>
        <div class="col-md-6 pull-left">
            <h4>{{Lang::get('admin/drivers.addNewDriver')}}</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'AdminDriverController@store', 'class'=>'form-row']) !!}

            <div class="form-group col-md-6">
                {!! Form::label('name', Lang::get('admin/drivers.name')) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('phone', Lang::get('admin/drivers.phone')) !!}
                {!! Form::text('phone', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('company', Lang::get('admin/drivers.company')) !!}
                {!! Form::text('company', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('extra', Lang::get('admin/drivers.extraInfo')) !!}
                {!! Form::textarea('extra', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-grop col-md-12">
                {!! Form::submit(Lang::get('admin/drivers.add'), ['class'=>'btn btn-primary pull-right']) !!}
            </div>

            {!! Form::close() !!}

            @include('includes.formError')

        </div>
        <div class="col-md-6 pull-right">
            <h4>{{Lang::get('admin/drivers.browse')}}</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{Lang::get('admin/drivers.id')}}</th>
                    <th>{{Lang::get('admin/drivers.name')}}</th>
                    <th>{{Lang::get('admin/drivers.company')}}</th>
                    <th>{{Lang::get('admin/drivers.amountOfTransports')}}</th>
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
