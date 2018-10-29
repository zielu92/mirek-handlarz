@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::choice('admin/customers.customers', 2)}}</h1>
        <div class="col-md-6 pull-left">
            <h4>{{Lang::get('admin/customers.addNewCustomer')}}</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'AdminCustomerController@store', 'class'=>'form-row']) !!}

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
                {!! Form::submit(Lang::get('admin/customers.add'), ['class'=>'btn btn-primary pull-right']) !!}
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
                    <th>{{Lang::get('admin/customers.name')}}</th>
                    <th>{{Lang::get('admin/customers.amountOfVehicles')}}</th>
                    <th>{{Lang::get('admin/customers.lastActivity')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($customers)
                    @foreach($customers->sortByDesc('id') as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td><a href="{{route('admin.customer.show', $customer->id)}}">{{ $customer->name }}</a></td>
                            <td>{{$customer->car->count()}}</td>
                            <td>{{$customer->car->last() ? $customer->car->last()->sold_date : 'XXXX-XX-XX'}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
