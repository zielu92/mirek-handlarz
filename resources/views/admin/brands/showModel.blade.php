@extends('admin.layout.admin')


@section('content')
    <div class="col-md-12">
        <div class="pull-left">
            <h1>Pojazdy według modelu</h1>
            <p>Kliknij w rekord aby edytować</p>
        </div>
        <div class="pull-right">
            <a href="{{route('admin.brand.index')}}" class="btn btn-success btn-lg addbtn">Dodaj Nową markę/model</a>
            <a href="{{route('admin.cars.create')}}" class="btn btn-info btn-lg addbtn">Dodaj Nowy</a>
        </div>

        <table class="table table-sm">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Pojazd</th>
                <th>VIN</th>
                <th>Cena zakupu</th>
                <th>Cena sprzedaży</th>
                <th>Zakupiono</th>
                <th>Sprzedano</th>
                <th>Data zakupu</th>
                <th>Data sprzedaży</th>
                <th>Data przyjęcia</th>
                <th>Data wydania</th>
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
                        <td>{{$car->bought_price}}</td>
                        <td>{{$car->sold_price}}</td>
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