@extends('admin.layout.admin')


@section('content')
        <div class="col-lg-12">
            <h1>{{Lang::get('admin/cars.addNewCar')}}</h1>

            {!! Form::open(['method'=>'POST', 'action'=>'AdminCarsController@store', 'files'=>true, 'class'=>'form-row']) !!}

            <div class="form-group col-md-4">
                {!! Form::label('brand_id', Lang::get('admin/cars.brand')) !!}
                {!! Form::select('brand_id', ['' => Lang::get('admin/cars.select')] + $brands, null,
                ['class'=>'form-control brand-list']) !!}
            </div>


            <div class="form-group col-md-4">
                {!! Form::label('model_id', Lang::get('admin/cars.model')) !!}
                {!! Form::select('model_id', ['' => ''], null, ['class'=>'form-control brand-list']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('vin', Lang::get('admin/cars.vin')) !!}
                {!! Form::text('vin', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('bought_price', Lang::get('admin/cars.boughtPrice')) !!}
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::text('bought_price', null,  ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::select('bought_currency', $currencies, null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('sold_price', Lang::get('admin/cars.sellPrice')) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('sold_price', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::select('sold_currency', $currencies, null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('from', Lang::get('admin/cars.whereBought')) !!}
                {!! Form::text('from', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('offer_id', Lang::get('admin/cars.noOffer')) !!}
                {!! Form::text('offer_id', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('customer_id', Lang::get('admin/cars.whoBought')) !!}
                {{ Form::text('customer_id', '', ['id' => 'customer_id', 'class'=>'form-control'])}}
            </div>

            <input type="hidden" id="lang" vale="{{Config::get('app.locale')}}">

            <div class="form-group col-md-2">
                {!! Form::label('bought_date', Lang::get('admin/cars.boughtDate')) !!}
                {!! Form::date('bought_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('in_warehouse_date', Lang::get('admin/cars.wareouseDate')) !!}
                {!! Form::date('in_warehouse_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('sold_date', Lang::get('admin/cars.soldDate')) !!}
                {!! Form::date('sold_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('left_warehouse_date', Lang::get('admin/cars.leaveDate')) !!}
                {!! Form::date('left_warehouse_date', null,  ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('extra', Lang::get('admin/cars.extraInfo')) !!}
                {!! Form::textarea('extra', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit(Lang::get('admin/cars.addVehicle'), ['class'=>'btn btn-primary pull-right']) !!}
                {!! Form::submit(Lang::get('admin/cars.addVehicleAndPic'), ['name'=>'pics','class'=>'btn btn-secondary pull-right']) !!}
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
                        var modelOfCar = JSON.parse(data);
                        var output;
                        for (var i in modelOfCar)
                        {
                            output += "<option value='" + modelOfCar[i].id + "'>"+ modelOfCar[i].model + "</option>";
                        }
                        $("#model_id").html(output);
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

        $( "#bought_date" ).datetimepicker({locale: '{{Config::get('app.locale')}}' });
    </script>
@endsection