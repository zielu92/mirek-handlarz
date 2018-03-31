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
                    <div class="mr-5"> {{$transports}} transport w tym tygodniu!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.transport.index')}}">
                    <span class="float-left">Zobacz</span>
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
                    <div class="mr-5">{{$carsBought}} zakupionych w tym tygodniu!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.cars.index')}}">
                    <span class="float-left">Zobacz</span>
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
                    <div class="mr-5">{{$carsSold}} sprzedanych w tym tygodniu!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.cars.index')}}">
                    <span class="float-left">Zobacz</span>
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
                    <div class="mr-5">{{$notSold}} niesprzedanych w tym tygodniu</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.cars.index')}}">
                    <span class="float-left">Zobacz</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
    </div>
    <!-- buy sell chart-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Sprzedaż/Zakup</div>
        <div class="card-body">
            <canvas id="buySell" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Na dzień {{ date('d-m-Y') }}</div>
    </div>

        <!-- car status chart-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-pie-chart"></i> Statusy 100 ostatnich pojazdów</div>
        <div class="card-body">
            <canvas id="statusChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Na dzień {{ date('d-m-Y') }}</div>
    </div>


    <!--  older than 30 days and not sold table -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table" id="neverSold"></i> Pojazdy, starze niż 30 dni nadal pozostają niesprzedane lub nigdy
            nieprzybyły do magazynu</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Pojazd</th>
                        <th>VIN</th>
                        <th>Cena zakupu</th>
                        <th>Cena sprzedaży</th>
                        <th>Zakupiono</th>
                        <th>Data zakupu</th>
                        <th>Data przyjęcia</th>
                        <th>Akcje</th>
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
                                <td><a href="{{route('admin.cars.edit',$carns->id)}}">Edytuj</a></td>
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
                    label: "kupno",
                    borderColor: "#287ecd",
                    backgroundColor: "rgba(81, 125, 214, 0.4)",
                    fill: true
                }, {
                    data: [@foreach($soldBought as $dataChart)
                        {{$dataChart['bought'].','}}
                        @endforeach],
                    label: "Sprzedaż",
                    borderColor: "#28a745",
                    backgroundColor: "rgba(46,201,79,0.4)",
                    fill: true
                }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Sprzedaż oraz kupna auta w przeciągu ostatnich 7 dni'
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
                            labelString: 'ilość aut',
                            fontSize: 20
                        }
                    }]
                }
            }
        });


        new Chart(document.getElementById("statusChart"), {
            type: 'pie',
            data: {
                labels: ["Zakupiony", "Na magazynie", "Sprzedany", "Sprzedany, ale brak na magazynie",
                    "Sprzedany i wydany", "Starszy niż 30 dni i niesprzedany"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#41c483","#e8ac31","#00ba1b","#bc000f"],
                    data: [{{$status['status1'].','.$status['status2'].','.$status['status3'].','.
                    $status['status4'].','.$status['status5'].','.$status['status6']}}]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Statusy 100 ostatnio dodanych pojazdów'
                }
            }
        });

    </script>
@endsection