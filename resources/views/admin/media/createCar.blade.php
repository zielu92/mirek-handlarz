@extends('admin.layout.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
@endsection

@section('content')
    <div class="col-md-12">
        <h1>Dodaj zdjęcia dla pojazdu #{{$car->id}} {{$car->model->brand->name}} {{$car->model->model}}</h1>
        <p>Dodaj zdjęcia przeciągając je w ramkę poniżej</p>

        {!! Form::open(['method'=>'POST', 'action'=>'AdminMediasController@store', 'class'=>'dropzone']) !!}

        {!! Form::hidden('car_id', $car->id) !!}

        {!! Form::close() !!}
    </div>
    <br>
    <div class="col-md-12">
        <a href="{{route('admin.cars.create')}}" class="btn btn-primary pull-left">dodaj następny rekod</a>
    </div>
    <div class="col-md-12">
        <a href="{{route('admin.cars.show', $car->id)}}" class="btn btn-secondary pull-left">przejdź do podglądu</a>
    </div>
@endsection



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
@endsection