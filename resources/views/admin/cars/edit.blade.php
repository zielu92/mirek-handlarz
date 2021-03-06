@extends('admin.layout.admin')


@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::get('admin/cars.addNewCar')}}</h1>

        {!! Form::model($car,['method'=>'PATCH', 'action'=>['AdminCarsController@update', $car->id], 'class'=>'form-row']) !!}

        <div class="form-group col-md-4">
            {!! Form::label('brand_id', Lang::get('admin/cars.brand')) !!}
            {!! Form::select('brand_id', ['' => Lang::get('admin/cars.select')] + $brands, null,
            ['class'=>'form-control brand-list']) !!}
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('model_id', Lang::get('admin/cars.model')) !!}
            @if(isset($car->model->model))
            {!! Form::select('model_id', [$car->model_id => $car->model->model], null, ['class'=>'form-control brand-list']) !!}
            @else
            {!! Form::select('model_id', ['' => ''], null, ['class'=>'form-control brand-list']) !!}
            @endif
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
            {!! Form::label('offer_id', Lang::get('admin/cars.noOfer')) !!}
            {!! Form::text('offer_id', null,  ['class'=>'form-control']) !!}
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('customer_id', Lang::get('admin/cars.whoBought')) !!}
            {{ Form::text('customer_id', $car->customer_id ?'#'.$car->customer_id.' '.$car->customer->name : null,
             ['id' => 'customer_id', 'class'=>'form-control'])}}
        </div>

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

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::submit(Lang::get('admin/cars.updateRecord'), ['class'=>'btn btn-primary pull-left']) !!}
                {!! Form::submit(Lang::get('admin/cars.updateAndPic'),['name'=>'pics', 'value' => 'withPictures',
                'class'=>'btn btn-secondary pull-left']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCarsController@destroy', $car->id]]) !!}
            <div class="form-group">

                {!! Form::submit(Lang::get('admin/cars.delete'), ['class'=>'btn btn-danger pull-right',
                'onclick'=>'return confirm('.Lang::get('admin/cars.confirmToDelete').');']) !!}
            </div>
            {!! Form::close() !!}

            <a href="{{route('admin.cars.show', $car->id)}}" class="btn btn-success pull-right">
                {{Lang::get('admin/cars.showPreview')}}
            </a>
        </div>
    </div>
    @include('includes.formError')
    @include('includes.carPictures')
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