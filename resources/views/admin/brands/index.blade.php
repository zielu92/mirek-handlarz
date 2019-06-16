@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::get('admin/brands.modelsAndBrands')}}</h1>
        <div class="col-md-6 pull-left">
            <h4>Dodaj nową</h4>
                {!! Form::open(['method'=>'POST', 'action'=>'AdminModelBrandController@store', 'class'=>'form-row']) !!}
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
                        '4'=>Lang::get('admin/brands.agriculturalMachine'),
                        '5'=>Lang::get('admin/brands.other')], null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-grop col-md-12">
                        {!! Form::submit(Lang::get('admin/brands.add'), ['class'=>'btn btn-primary pull-right']) !!}
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
                      <th>Ilość modeli</th>
                      <th>Transakcje z tą marką</th>
                  </tr>
                </thead>
                <tbody>
                @if($brands)
                    @foreach($brands as $brand)
                      <tr>
                          <td>{{ $brand->id }}</td>
                          <td><a href="{{route('admin.brand.show', $brand->id)}}">{{ $brand->name }}</a></td>
                          <td>@if($brand->model)
                                {{ $brand->model->count() }}
                              @endif
                          </td>
                          <td>@if($brand->model)
                                  {{ $brand->cars->count() }}
                              @endif
                          </td>
                      </tr>
                    @endforeach
                @endif
                </tbody>
             </table>
        </div>
    </div>

@endsection
