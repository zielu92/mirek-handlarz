@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::get('admin/brands.modelsAndBrands')}}</h1>
        <div class="col-md-6 pull-left">
            <h4>{{Lang::get('admin/brands.editing')}} {{$model->model}}</h4>
            {!! Form::model($model,['method'=>'PATCH', 'action'=>['AdminModelBrandController@update', $model->id],
            'class'=>'form-row']) !!}
            <div class="form-group col-md-6">
                {!! Form::label('brand_id', Lang::get('admin/brands.choiceFromList')) !!}
                {!! Form::select('brand_id',  $brand, null, ['class'=>'form-control brand-list']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name', Lang::get('admin/brands.giveName')) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('model', Lang::get('admin/brands.model')) !!}
                {!! Form::text('model', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('mode_code', Lang::get('admin/brands.shortName')) !!}
                {!! Form::text('mode_code', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('type', Lang::get('admin/brands.type')) !!}
                {!! Form::select('type', [ '1' => Lang::get('admin/brands.car'),
                '2'=>Lang::get('admin/brands.motorbike'), '3'=>Lang::get('admin/brands.bike'),
                '4'=>Lang::get('admin/brands.agriculturalMachine'), '5'=>Lang::get('admin/brands.other')], null,
                ['class'=>'form-control']) !!}
            </div>

            <div class="form-grop col-md-12">
                {!! Form::submit(Lang::get('admin/brands.edit'), ['class'=>'btn btn-primary pull-right']) !!}
            </div>

            {!! Form::close() !!}

            @include('includes.formError')

        </div>
    </div>
@endsection