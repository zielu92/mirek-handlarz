@extends('admin.layout.admin')


@section('content')
<div class="col-md-12">
    <div class="pull-left">
        <h1>{{Lang::get('admin/cars.indexTitle')}}</h1>
        <p>{{Lang::get('admin/cars.clickToEdit')}}</p>
    </div>
     <div class="pull-right">
         <a href="{{route('admin.cars.create')}}" class="btn btn-info btn-lg addbtn">
             {{Lang::get('admin/cars.addNewCar')}}
         </a>
         <a href="{{route('admin.brand.index')}}" class="btn btn-success btn-lg addbtn">
             {{Lang::get('admin/cars.addNewModel')}}
         </a>
     </div>

     <table class="table table-sm">
         <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>{{Lang::get('admin/cars.vehicle')}}</th>
                <th>{{Lang::get('admin/cars.vin')}}</th>
                <th>{{Lang::get('admin/cars.boughtPrice')}}</th>
                <th>{{Lang::get('admin/cars.sellPrice')}}</th>
                <th>{{Lang::get('admin/cars.bought')}}</th>
                <th>{{Lang::get('admin/cars.sold')}}</th>
                <th>{{Lang::get('admin/cars.boughtDate')}}</th>
                <th>{{Lang::get('admin/cars.soldDate')}}</th>
                <th>{{Lang::get('admin/cars.wareouseDate')}}</th>
                <th>{{Lang::get('admin/cars.leaveDate')}}</th>
            </tr>
        </thead>
        <tbody>
        @if($cars)
            @foreach($cars->sortByDesc('id') as $car)
                <tr data-href='{{route('admin.cars.edit', $car->id)}}' class="clickable-row
                @switch($car->status())
                    @case(1)
                        table-light
                    @break
                    @case(2)
                        table-info
                    @break
                    @case(3)
                        table-success
                    @break
                    @case(4)
                        table-warning
                    @break
                    @case(5)
                        table-dark
                    @break
                    @case(6)
                        table-danger
                    @break
                    @default
                        table-secondary
                    @endswitch
                ">
                    <td>{{$car->id}}</td>
                    <td>
                        @if($car->model)
                             <b>{{$car->model->brand->name}}</b> {{$car->model->model}}
                        @endif
                    </td>
                    <td>{{$car->vin}}</td>
                    <td>{{$car->bought_price}} {{$car->bought_currency}}</td>
                    <td>{{$car->sold_price}} {{$car->sold_currency}}</td>
                    <td>{{$car->from}}</td>
                    <td>{{$car->customer ? $car->customer->name : ''}}</td>
                    <td>{{$car->bought_date}}</td>
                    <td>{{$car->sold_date}}</td>
                    <td>{{$car->in_warehouse_date}}</td>
                    <td>{{$car->left_warehouse_date}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
     </table>
     <div class="row">
         <div class="col-sm-6 col-sm-offset-5">
            {{$cars->render()}}
         </div>
     </div>
</div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection