@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>Dodaj transport</h1>
        <div class="col-md-6 pull-left">
            <h4>Dodaj nową</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'AdminTransportController@store', 'class'=>'form-row']) !!}

            <div class="form-group col-md-6">
                {!! Form::label('driver_id', 'Kierowca') !!}
                {!! Form::text('driver_id', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('plates', 'Numery rejestracyjne') !!}
                {!! Form::text('plates', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12 transports">
                <label for="transport[]">Pojazdy na transporcie zacznij wpisywac VIN lub ID lub date zakupu </label>
                <input class="form-control car-transport" name="transport[]" id="transport[]" type="text">
            </div>

            <div class="form-group col-md-12 transports batch">

            </div>

            <div class="col-md-6">
                <p id="addCar"><i class="fa fa-fw fa-lg fa-plus"></i>Dodaj nastepny pojazd</p>
            </div>

            <div class="form-group col-md-3">
                {!! Form::label('transport_date', 'Data transportu') !!}
                {!! Form::date('transport_date', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-3">
                {!! Form::label('type', 'typ') !!}
                {!! Form::select('type', [ '1' => 'Przywóz', '2'=>'Wywóz'], null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
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
                    <th>Typ</th>
                    <th>Rejestracja</th>
                    <th>Kierowca</th>
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
                            <td>{{$transport->driver->name}}</td>
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

@section('scripts')
    <script>


        $("#addCar").click(function(){
            var begin = "<label for=\"transport[]\">Kolejny pojazd na transporcie</label>\n" +
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
