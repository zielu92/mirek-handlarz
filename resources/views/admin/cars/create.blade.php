@extends('admin.layout.admin')


@section('content')
        <div class="col-lg-12">
            <h1>Dodaj nowy rekord</h1>

            {!! Form::open(['method'=>'POST', 'action'=>'AdminCarsController@store', 'files'=>true, 'class'=>'form-row']) !!}

            <div class="form-group col-md-4">
                {!! Form::label('brand_id', 'Marka:') !!}
                {!! Form::select('brand_id', ['' => 'Wybierz'] + $brands, null, ['class'=>'form-control brand-list']) !!}
            </div>


            <div class="form-group col-md-4">
                {!! Form::label('model_id', 'Model:') !!}
                {!! Form::select('model_id', ['' => ''], null, ['class'=>'form-control brand-list']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('vin', 'VIN:') !!}
                {!! Form::text('vin', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('bought_price', 'Cena zakupu:') !!}
                {!! Form::text('bought_price', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('sold_price', 'Cena sprzedaży:') !!}
                {!! Form::text('sold_price', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('from', 'Gdzie zakupiono:') !!}
                {!! Form::text('from', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('offer_id', 'Numer oferty:') !!}
                {!! Form::text('offer_id', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('customer_id', 'Komu sprzedano:') !!}
                {{ Form::text('customer_id', '', ['id' => 'customer_id', 'class'=>'form-control'])}}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('bought_date', 'Data zakupu:') !!}
                {!! Form::date('bought_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('in_warehouse_date', 'Data przyjęcia:') !!}
                {!! Form::date('in_warehouse_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('sold_date', 'Data sprzedaży:') !!}
                {!! Form::date('sold_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('left_warehouse_date', 'Data wyjazdu pojazdu:') !!}
                {!! Form::date('left_warehouse_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('extra', 'Uwagi') !!}
                {!! Form::textarea('extra', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit('Dodaj pojazd', ['class'=>'btn btn-primary pull-right']) !!}
                {!! Form::submit('Dodaj pojazd oraz zdjęcia', ['name'=>'pics','class'=>'btn btn-secondary pull-right']) !!}
            </div>


            {!! Form::close() !!}
        </div>

    @include('includes.formError')

@endsection

@section('scripts')
    <script>
        $('.brand-list option').on('click', function() {
            var brand_id = $(this).val();
            $.ajax({

                url: '/admin/cars/model/' + brand_id,
                data: {
                    _method: 'GET',
                },
                type: "POST",
                success: function (data) {

                    if (!data.error) {
                        $("#model_id").html(data);
                    }

                }

            });
        });

        $(function()
        {
            $( "#customer_id" ).autocomplete({
                source: "/admin/cars/auto/complete",
                messages: {
                    noResults: '',
                    results: function() {}
                },
                minLength: 2,
                select: function(event, ui) {
                    $('#customer_id').val(ui.item.value);
                }
            });
        });
    </script>
@endsection