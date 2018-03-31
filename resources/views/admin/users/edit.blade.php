@extends('admin.layout.admin')


@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Edytuj użytkownika</h1>
    </div>
        @if($user->photo)
            <div class="col-md-3">

                <img src="{{$user->photo->path}}" alt="" width="200px" class="img-responsive img-rounded">

            </div>
        @endif
    <div class="col-md-6">
        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

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
            {!! Form::select('is_admin', [0 => 'Użytkownik', 1 => 'Administrator'], null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo', 'file:') !!}
            {!! Form::file('photo', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Edytuj', ['class'=>'btn btn-primary pull-left']) !!}
        </div>


        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Usuń', ['class'=>'btn btn-danger pull-right']) !!}
        </div>


        {!! Form::close() !!}
    </div>

</div>
@include('includes.formError')

@endsection