@extends('admin.layout.admin')


@section('content')
    <div class="col-lg-12">
        <h4>{{Lang::get('admin/users.editUser')}}</h4>

        <div class="row">
            <div class="form-group col-md-6">
            @if($user->photo)
                <div class="col-md-3">

                    <img src="{{$user->photo->path}}" class="img-responsive img-rounded editPic">

                </div>
            @endif
            </div>
        <div class="col-md-6">
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id],
            'files'=>true]) !!}

            <div class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('name', Lang::get('admin/users.name')) !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-md-12">
                    {!! Form::label('email', Lang::get('admin/users.email')) !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-md-12">
                    {!! Form::label('password', Lang::get('admin/users.pass')) !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-md-12">
                    {!! Form::label('is_admin', Lang::get('admin/users.role')) !!}
                    {!! Form::select('is_admin', [1 => Lang::get('admin/users.admin'),
                    0 => Lang::get('admin/users.user')],
                    null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-md-12">
                    {!! Form::label('photo', Lang::get('admin/users.photo')) !!}
                    {!! Form::file('photo', null, ['class'=>'form-control']) !!}
                </div>


                <div class="form-group">
                {!! Form::submit(Lang::get('admin/users.edit'), ['class'=>'btn btn-primary pull-left']) !!}
            </div>


            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
            <div class="form-group">
                {!! Form::submit(Lang::get('admin/users.delete'), ['class'=>'btn btn-danger pull-right']) !!}
            </div>


            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@include('includes.formError')

@endsection