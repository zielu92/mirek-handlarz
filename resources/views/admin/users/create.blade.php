@extends('admin.layout.admin')


@section('content')
<div class="row col-md-12">
    <div class="col-md-3">
        <h1>Dodaj użytkownika</h1>
    </div>
    <div class="col-md-6">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nazwa:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Hasło:') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_admin', 'Rola:') !!}
            {!! Form::select('is_admin', [1 => 'Administrator', 0 => 'Użytkownik'], null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo', 'zdjęcie:') !!}
            {!! Form::file('photo', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Dodaj', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
</div>
@include('includes.formError')

@endsection