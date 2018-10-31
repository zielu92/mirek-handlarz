@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::choice('admin/transports.transports',2)}}</h1>
        <div class="col-md-6 pull-left">
            <h4>{{Lang::get('admin/transports.addNew')}}</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'AdminTransportController@store', 'class'=>'form-row']) !!}

            <div class="form-group col-md-6">
                {!! Form::label('driver_id', Lang::get('admin/transports.driver')) !!}
                {!! Form::text('driver_id', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('plates', Lang::get('admin/transports.plates')) !!}
                {!! Form::text('plates', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12 transports">
                <label for="transport[]">{{Lang::get('admin/transports.vehiclesInTrasport')}} </label>
                <input class="form-control car-transport" name="transport[]" id="transport[]" type="text">
            </div>

            <div class="form-group col-md-12 transports batch">

            </div>

            <div class="col-md-6">
                <p id="addCar"><i class="fa fa-fw fa-lg fa-plus"></i>{{Lang::get('admin/transports.addNextVehicle')}}</p>
            </div>

            <div class="form-group col-md-3">
                {!! Form::label('transport_date', Lang::get('admin/transports.date')) !!}
                {!! Form::date('transport_date', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-3">
                {!! Form::label('type', Lang::get('admin/transports.type')) !!}
                {!! Form::select('type', [ '1' => Lang::get('admin/transports.typeIn'),
                '2'=>Lang::get('admin/transports.typeOut')], null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('extra', Lang::get('admin/transports.comment')) !!}
                {!! Form::textarea('extra', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-grop col-md-12">
                {!! Form::submit(Lang::get('admin/transports.add'), ['class'=>'btn btn-primary pull-right']) !!}
            </div>

            {!! Form::close() !!}

            @include('includes.formError')

        </div>
        <div class="col-md-6 pull-right">
            <h4>{{Lang::get('admin/transports.browse')}}</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{Lang::get('admin/transports.id')}}</th>
                    <th>{{Lang::get('admin/transports.type')}}</th>
                    <th>{{Lang::get('admin/transports.plates')}}</th>
                    <th>{{Lang::get('admin/transports.driver')}}</th>
                    <th>{{Lang::get('admin/transports.date')}}</th>
                    <th>{{Lang::get('admin/transports.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($transports)
                    @foreach($transports->sortByDesc('id') as $transport)
                        <tr>
                            <td>{{ $transport->id }}</td>
                            <td>@if($transport->type ==1)
                                    <i class="fa fa-lg fa-arrow-left badge-success rounded" title="{{Lang::get('admin/transports.typeIn')}}">
                                @else
                                    <i class="fa fa-lg fa-arrow-right badge-danger rounded" title="{{Lang::get('admin/transports.typeOut')}}">
                                @endif
                            </td>
                            <td>{{$transport->plates}}</td>
                            <td>{{$transport->driver->name}}</td>
                            <td>{{$transport->transport_date}}</td>
                            <td><a href="{{route('admin.transport.show', $transport->id)}}">
                                    {{Lang::get('admin/transports.details')}}
                                </a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{$transports->render()}}
        </div>
    </div>

@endsection

@section('scripts')
    <script>


        $("#addCar").click(function(){
            var begin = "<label for=\"transport[]\">{{Lang::get('admin/transports.addNextVehicle')}}</label>\n" +
                "<input class=\"form-control car-transport\" name=\"transport[]\" id=\"transport[]\" type=\"text\">\n";

            $(".batch").append(begin);

            $( ".transports" ).find('input[type=text]:last').autocomplete({
                source: "/admin/transport/find/car",
                messages: {
                    noResults: '',
                    results: function() {}
                },
                minLength: 1,
                select: function(event, ui) {
                    $(this).val(ui.item.value);
                }
            });
        });

        $(document).ready(function ()
        {
            $( ".car-transport" ).autocomplete({
                source: "/admin/transport/find/car",
                messages: {
                    noResults: '',
                    results: function() {}
                },
                minLength: 1,
                select: function(event, ui) {
                    $(this).val(ui.item.value);
                }
            });
        });


        $(document).ready(function ()
        {
            $( "#driver_id" ).autocomplete({
                source: "/admin/transport/find/driver",
                messages: {
                    noResults: '',
                    results: function() {}
                },
                minLength: 1,
                select: function(event, ui) {
                    $(this).val(ui.item.value);
                }
            });
        });

    </script>
@endsection
