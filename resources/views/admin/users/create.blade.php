@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h4>{{Lang::get('admin/users.addNew')}}</h4>
        {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('name', Lang::get('admin/users.name')) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('email', Lang::get('admin/users.email')) !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('password', Lang::get('admin/users.pass')) !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('is_admin', Lang::get('admin/users.role')) !!}
                {!! Form::select('is_admin', [1 => Lang::get('admin/users.admin'), 0 => Lang::get('admin/users.user')],
                null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo', Lang::get('admin/users.photo')) !!}
                {!! Form::file('photo', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::submit(Lang::get('admin/users.create'), ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@include('includes.formError')

@endsection