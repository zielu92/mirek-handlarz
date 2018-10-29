@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::choice('admin/customers.customers', 1)}} #{{$customer->id}} {{$customer->name}}</h1>
        <div class="col-md-6 pull-left">
            <h4>{{Lang::get('admin/customers.editCustomer')}}</h4>
            {!! Form::model($customer, ['method'=>'PATCH', 'action'=>['AdminCustomerController@update', $customer->id],
             'class'=>'form-row']) !!}

            <div class="form-group col-md-6">
                {!! Form::label('name', Lang::get('admin/customers.name')) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('phone', Lang::get('admin/customers.phone')) !!}
                {!! Form::text('phone', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('address', Lang::get('admin/customers.address')) !!}
                {!! Form::textarea('address', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('extra', Lang::get('admin/customers.extraInfo')) !!}
                {!! Form::textarea('extra', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-grop col-md-12">
                {!! Form::submit(Lang::get('admin/customers.save'), ['class'=>'btn btn-primary pull-right']) !!}
            </div>

            {!! Form::close() !!}

            @include('includes.formError')

        </div>
        <div class="col-md-6 pull-right">
            <h4>{{Lang::get('admin/customers.browse')}}</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{Lang::get('admin/customers.id')}}</th>
                    <th>{{Lang::get('admin/customers.vehicle')}}</th>
                    <th>{{Lang::get('admin/customers.sellPrice')}}</th>
                    {{--<th>{{Lang::get('admin/customers.profit')}}</th>--}}
                    <th>{{Lang::get('admin/customers.boughtDate')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($cars)
                    @foreach($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td><a href="{{route('admin.cars.show', $car->id)}}">
                                    @if($car->model)
                                        <b>{{$car->model->brand->name}}</b> {{$car->model->model}}
                                    @endif
                                </a>
                            </td>
                            <td>{{$car->sold_price}} {{$car->sold_currency}}</td>
                            {{--<td>{{$customer->profit($car->bought_price,$car->sold_price)}}</td>--}}
                            <td>{{$car->sold_date}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
