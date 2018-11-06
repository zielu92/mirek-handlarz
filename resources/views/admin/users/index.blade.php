@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <div class="pull-left">
            <h1>{{Lang::choice('admin/users.users',2)}}</h1>
        </div>
        <div class="pull-right">
            <a href="{{route('admin.users.create')}}" class="btn btn-info btn-lg addbtn">
                {{Lang::get('admin/users.addNew')}}
            </a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{Lang::get('admin/users.id')}}</th>
                    <th>{{Lang::get('admin/users.name')}}</th>
                    <th>{{Lang::get('admin/users.email')}}</th>
                    <th>{{Lang::get('admin/users.role')}}</th>
                    <th>{{Lang::get('admin/users.created')}}</th>
                    <th>{{Lang::get('admin/users.edited')}}</th>
                </tr>
            </thead>
            <tbody>
            @if($users)
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->is_admin == 1 ? Lang::get('admin/users.admin') : Lang::get('admin/users.user')}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        {{$users->render()}}
    </div>

@endsection
