@extends('admin.layout.admin')

@section('content')
<div class="container-fluid">
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-truck"></i>
                    </div>
                    <div class="mr-5"> {{$transports}} {{Lang::choice('admin/index.transport', $transports)}}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.transport.index')}}">
                    <span class="float-left">{{Lang::get('admin/index.check')}}</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-car"></i>
                    </div>
                    <div class="mr-5">{{$carsBought}} {{Lang::choice('admin/index.bought', $carsBought)}}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.cars.index')}}">
                    <span class="float-left">{{Lang::get('admin/index.check')}}</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-dollar"></i>
                    </div>
                    <div class="mr-5">{{$carsSold}} {{Lang::choice('admin/index.sold', $carsSold)}}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.cars.index')}}">
                    <span class="float-left">{{Lang::get('admin/index.check')}}</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-frown-o"></i>
                    </div>
                    <div class="mr-5">{{$notSold}} {{Lang::choice('admin/index.notSold', $notSold)}}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.cars.index')}}">
                    <span class="float-left">{{Lang::get('admin/index.check')}}</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
    </div>
    <!-- buy sell chart-->
    <div class="card mb-2">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> {{Lang::get('admin/index.buy')}}/{{Lang::get('admin/index.sell')}}
        </div>
        <div class="card-body">
            <canvas id="buySell" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">{{ date('d-m-Y') }}</div>
    </div>

        <!-- car status chart-->
    <div class="card mb-2">
        <div class="card-header">
            <i class="fa fa-pie-chart"></i> {{Lang::get('admin/index.statusOfLastCars')}}
        </div>
        <div class="card-body">
            <canvas id="statusChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">{{ date('d-m-Y') }}</div>
    </div>

    <!--  older than 30 days and not sold table -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table" id="neverSold"></i> {{Lang::get('admin/index.problematicsVehicles')}}</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>{{Lang::get('admin/index.vehicle')}}</th>
                        <th>{{Lang::get('admin/index.vin')}}</th>
                        <th>{{Lang::get('admin/index.buyingPrice')}}</th>
                        <th>{{Lang::get('admin/index.sellingPrice')}}</th>
                        <th>{{Lang::get('admin/index.boughten')}}</th>
                        <th>{{Lang::get('admin/index.buyingDate')}}</th>
                        <th>{{Lang::get('admin/index.warehouseDate')}}</th>
                        <th>{{Lang::get('admin/index.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($carsNeverSold)
                        @foreach($carsNeverSold->sortByDesc('id') as $carns)
                            <tr>
                                <td>{{$carns->id}}</td>
                                <td>
                                    @if($carns->model)
                                        <a href="{{route('admin.cars.show',$carns->id)}}">
                                        <b>{{$carns->model->brand->name}}</b> {{$carns->model->model}}
                                        </a>
                                    @endif
                                </td>
                                <td>{{$carns->vin}}</td>
                                <td>{{$carns->bought_price}}</td>
                                <td>{{$carns->sold_price}}</td>
                                <td>{{$carns->from}}</td>
                                <td>{{$carns->bought_date}}</td>
                                <td>{{$carns->in_warehouse_date}}</td>
                                <td><a href="{{route('admin.cars.edit',$carns->id)}}" class="btn btn-info">
                                        {{Lang::get('admin/index.edit')}}
                                    </a>
                                    <a href="{{route('admin.cars.show',$carns->id)}}" class="btn btn-primary">
                                        {{Lang::get('admin/index.browse')}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <script>

        new Chart(document.getElementById("buySell"), {
            type: 'line',
            data: {
                labels: [@foreach($soldBought as $dataChart)
                    {{$dataChart['date'].','}}
                    @endforeach],
                datasets: [{
                    data: [@foreach($soldBought as $dataChart)
                        {{$dataChart['sold'].','}}
                        @endforeach],
                    label: "{{Lang::get('admin/index.buy')}}",
                    borderColor: "#287ecd",
                    backgroundColor: "rgba(81, 125, 214, 0.4)",
                    fill: true
                }, {
                    data: [@foreach($soldBought as $dataChart)
                        {{$dataChart['bought'].','}}
                        @endforeach],
                    label: "{{Lang::get('admin/index.sell')}}",
                    borderColor: "#28a745",
                    backgroundColor: "rgba(46,201,79,0.4)",
                    fill: true
                }
                ]
            },
            options: {
                legend: {
                    labels: {
                        fontSize: 16,
                    }
                },
                title: {
                    display: true,
                    text: "{{Lang::get('admin/index.buySellfromLaast')}}",
                    fontSize:20,
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            fontSize: 20
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "{{Lang::get('admin/index.amoutOfCars')}}",
                            fontSize: 20
                        }
                    }]
                }
            }
        });


        new Chart(document.getElementById("statusChart"), {
            type: 'pie',
            data: {
                labels: ["{{Lang::get('admin/index.boughten')}}", "{{Lang::get('admin/index.warehouse')}}",
                    "{{Lang::get('admin/index.solden')}}", "{{Lang::get('admin/index.soldNotWarehouse')}}",
                    "{{Lang::get('admin/index.soldAndReleased')}}", "{{Lang::get('admin/index.oldStllNotSold')}}"],
                datasets: [{
                    backgroundColor: ["#3e95cd", "#8e5ea2","#41c483","#e8ac31","#00ba1b","#bc000f"],
                    data: [{{$status['status1'].','.$status['status2'].','.$status['status3'].','.
                    $status['status4'].','.$status['status5'].','.$status['status6']}}]
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'left',
                    labels: {
                        fontSize: 18,
                    }
                }
            }
        });

    </script>
@endsection