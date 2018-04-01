@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>Modele i marki</h1>
        <div class="col-md-6 pull-left">
            <h4>Dodaj nową</h4>
                {!! Form::open(['method'=>'POST', 'action'=>'AdminModelBrandController@store', 'class'=>'form-row']) !!}
                    <div class="form-group col-md-6">
                        {!! Form::label('brand_id', 'Wybierz z listy lub') !!}
                        {!! Form::select('brand_id',  $brand, null, ['class'=>'form-control brand-list']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('name', 'podaj nazwę') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('model', 'model') !!}
                        {!! Form::text('model', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('mode_code', 'skrócona nazwa') !!}
                        {!! Form::text('mode_code', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('type', 'typ') !!}
                        {!! Form::select('type', [ '1' => 'Samochód', '2'=>'Motocykl', '3'=>'Rower',
                        '4'=>'Maszyna rolnicza', '5'=>'Inne'], null, ['class'=>'form-control']) !!}
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
                      <th>Nazwa</th>
                      <th>Ilość modeli</th>
                      <th>Trazakcje z tą marką</th>
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
                                {{ $brand->car->count()}}
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