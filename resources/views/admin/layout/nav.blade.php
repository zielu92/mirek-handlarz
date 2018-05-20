<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('admin')}}">Panel admina</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{route('admin')}}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Użytkownicy">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers">
                    <i class="fa fa-fw fa-users"></i>
                    <span class="nav-link-text">Użytkownicy</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseUsers">
                    <li>
                        <a href="{{route('admin.users.index')}}">Lista użytkowników</a>
                    </li>
                    <li>
                        <a href="{{route('admin.users.create')}}">Stwórz nowego użytkownika</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pojazdy">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCars">
                    <i class="fa fa-fw fa-car"></i>
                    <span class="nav-link-text">Pojazdy</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseCars">
                    <li>
                        <a href="{{route('admin.cars.index')}}">Lista pojazdów</a>
                    </li>
                    <li>
                        <a href="{{route('admin.cars.create')}}">Dodaj nowy pojazd</a>
                    </li>
                    <li>
                        <a href="{{route('admin.brand.index')}}">Marki i modele</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Transporty">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseTransports">
                    <i class="fa fa-fw fa-truck"></i>
                    <span class="nav-link-text">Transporty</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseTransports">
                    <li>
                        <a href="{{route('admin.transport.index')}}">Lista transportów</a>
                    </li>
                    <li>
                        <a href="{{route('admin.drivers.index')}}">Lista Kierowców</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Media">
                <a class="nav-link" href="{{route('admin.media.index')}}">
                    <i class="fa fa-fw fa-picture-o"></i>
                    <span class="nav-link-text">Media</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Klienci">
                <a class="nav-link" href="{{route('admin.customer.index')}}">
                    <i class="fa fa-fw fa-user-circle"></i>
                    <span class="nav-link-text">Klienci</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="O mirku handlarzu">
                <a class="nav-link" href="{{route('admin.about')}}">
                    <i class="fa fa-fw fa-info"></i>
                    <span class="nav-link-text">o mirku handlarzu</span>
                </a>
            </li>

        </ul>

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                {{--<a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--<i class="fa fa-fw fa-envelope"></i>--}}
                    {{--<span class="d-lg-none">Messages--}}
              {{--<span class="badge badge-pill badge-primary">12 New</span>--}}
            {{--</span>--}}
                    {{--<span class="indicator text-primary d-none d-lg-block">--}}
              {{--<i class="fa fa-fw fa-circle"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<div class="dropdown-menu" aria-labelledby="messagesDropdown">--}}
                    {{--<h6 class="dropdown-header">New Messages:</h6>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="#">--}}
                        {{--<strong>David Miller</strong>--}}
                        {{--<span class="small float-right text-muted">11:21 AM</span>--}}
                        {{--<div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="#">--}}
                        {{--<strong>Jane Smith</strong>--}}
                        {{--<span class="small float-right text-muted">11:21 AM</span>--}}
                        {{--<div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="#">--}}
                        {{--<strong>John Doe</strong>--}}
                        {{--<span class="small float-right text-muted">11:21 AM</span>--}}
                        {{--<div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item small" href="#">View all messages</a>--}}
                {{--</div>--}}
            {{--</li>--}}
            {{--<li class="nav-item dropdown">--}}
                {{--<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--<i class="fa fa-fw fa-bell"></i>--}}
                    {{--<span class="d-lg-none">Alerts--}}
              {{--<span class="badge badge-pill badge-warning">6 New</span>--}}
            {{--</span>--}}
                    {{--<span class="indicator text-warning d-none d-lg-block">--}}
              {{--<i class="fa fa-fw fa-circle"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<div class="dropdown-menu" aria-labelledby="alertsDropdown">--}}
                    {{--<h6 class="dropdown-header">New Alerts:</h6>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="#">--}}
              {{--<span class="text-success">--}}
                {{--<strong>--}}
                  {{--<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>--}}
              {{--</span>--}}
                        {{--<span class="small float-right text-muted">11:21 AM</span>--}}
                        {{--<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="#">--}}
              {{--<span class="text-danger">--}}
                {{--<strong>--}}
                  {{--<i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>--}}
              {{--</span>--}}
                        {{--<span class="small float-right text-muted">11:21 AM</span>--}}
                        {{--<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="#">--}}
              {{--<span class="text-success">--}}
                {{--<strong>--}}
                  {{--<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>--}}
              {{--</span>--}}
                        {{--<span class="small float-right text-muted">11:21 AM</span>--}}
                        {{--<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item small" href="#">View all alerts</a>--}}
                {{--</div>--}}
            {{--</li>--}}
           <li class="nav-item">
               {{ Form::close() }}

               {!! Form::open(['method'=>'GET','url'=>'admin/search', 'class'=>'form-inline my-2 my-lg-0 mr-lg-2']) !!}
               {!! Form::text('search', null, ['required',
                                           'id'=>'searchForm',
                                           'class'=>'form-control',
                                           'placeholder'=>Lang::get('search.searchPlacehold')]) !!}
               {!! Form::submit(Lang::get('search.search'),
                                          ['class'=>'btn btn-primary']) !!}
               {!! Form::close() !!}

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}">
                <i class="fa fa-fw fa-sign-out"></i>{{Lang::get('userForm.logout')}}</a>
            </li>

        </ul>
    </div>
</nav>
<br><br>
<div class="content-wrapper">
    @if(Session::has('msg'))
        <div class="msgs">
            <div class="alert alert-info">
                {{session('msg')}}
            </div>
        </div>
    @endif