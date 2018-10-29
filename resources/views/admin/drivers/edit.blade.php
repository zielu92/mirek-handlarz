@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::choice('admin/drivers.drivers', 1)}} #{{$driver->name}}</h1>
        <div class="col-md-6 pull-left">
            <h4>{{Lang::get('admin/drivers.editDriver')}}</h4>
            {!! Form::model($driver,['method'=>'PATCH', 'action'=>['AdminDriverController@update', $driver->id], 'class'=>'form-row']) !!}

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
                {!! Form::submit(Lang::get('admin/drivers.save'), ['class'=>'btn btn-primary pull-right']) !!}
            </div>

            {!! Form::close() !!}

            @include('includes.formError')

        </div>
        <div class="col-md-6 pull-right">
            <h4>{{Lang::get('admin/drivers.browse')}} {{Lang::get('admin/drivers.lastTransports')}}</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{Lang::get('admin/drivers.id')}}</th>
                    <th>{{Lang::get('admin/drivers.type')}}</th>
                    <th>{{Lang::get('admin/drivers.plates')}}</th>
                    <th>{{Lang::get('admin/drivers.date')}}</th>
                    <th>{{Lang::get('admin/drivers.action')}}</th>
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
                            <td><a href="{{route('admin.transport.show', $transport->id)}}">
                                    {{Lang::get('admin/drivers.details')}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{$transports->render()}}
        </div>
    </div>

@endsection
