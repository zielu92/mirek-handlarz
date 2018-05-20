@extends('admin.layout.admin')

@section('content')
    <div class="col-md-12">
    <h4>Przeglądaj modele dla marki {{$brand->name}}</h4>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>Nazwa</th>
            <th>Typ</th>
            <th>Transakcje z tym modelem</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        @if($models)
            @foreach($models as $model)
                <tr>
                    <td>{{ $model->id }}</td>
                    <td>{{$model->model}}</td>
                    <td>{{$model->type}}</td>
                    <td><a href="{{route('admin.brand.showModel', $model->id)}}">{{$model->car->count()}}</a></td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminModelBrandController@destroy',$model->id]]) !!}

                                {!! Form::submit('Usuń', ['class'=>'btn btn-danger pull-left',
                                'onclick'=>'return confirm(\'Czy chcesz usunąć rekord?\');']) !!}

                        {!! Form::close() !!}
                        <a href="{{route('admin.brand.edit', $model->id)}}" class="btn btn-primary pull-right">Edytuj</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
</div>

@endsection