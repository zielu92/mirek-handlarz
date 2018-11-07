<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('admin')}}">{{Lang::get('admin/nav.PA')}}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.Dashboard')}}">
                <a class="nav-link" href="{{route('admin')}}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.Dashboard')}}</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.users')}}">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers">
                    <i class="fa fa-fw fa-users"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.users')}}</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseUsers">
                    <li>
                        <a href="{{route('admin.users.index')}}">{{Lang::get('admin/nav.usersList')}}</a>
                    </li>
                    <li>
                        <a href="{{route('admin.users.create')}}">{{Lang::get('admin/nav.userCreate')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.vehicles')}}">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCars">
                    <i class="fa fa-fw fa-car"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.vehicles')}}</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseCars">
                    <li>
                        <a href="{{route('admin.cars.index')}}">{{Lang::get('admin/nav.vehiclesList')}}</a>
                    </li>
                    <li>
                        <a href="{{route('admin.cars.create')}}">{{Lang::get('admin/nav.vehicleCreate')}}</a>
                    </li>
                    <li>
                        <a href="{{route('admin.brand.index')}}">{{Lang::get('admin/nav.modelBrands')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.transports')}}">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseTransports">
                    <i class="fa fa-fw fa-truck"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.transports')}}</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseTransports">
                    <li>
                        <a href="{{route('admin.transport.index')}}">{{Lang::get('admin/nav.transportsList')}}</a>
                    </li>
                    <li>
                        <a href="{{route('admin.drivers.index')}}">{{Lang::get('admin/nav.driversList')}}</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.media')}}">
                <a class="nav-link" href="{{route('admin.media.index')}}">
                    <i class="fa fa-fw fa-picture-o"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.media')}}</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.customers')}}">
                <a class="nav-link" href="{{route('admin.customer.index')}}">
                    <i class="fa fa-fw fa-user-circle"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.customers')}}</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.options')}}">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseOptions">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.options')}}</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseOptions">
                    <li>
                        <a href="{{route('admin.options.index')}}">{{Lang::get('admin/nav.options')}}</a>
                    </li>
                    <li>
                        <a href="{{route('admin.rates.index')}}">{{Lang::get('admin/nav.rates')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{Lang::get('admin/nav.about')}}">
                <a class="nav-link" href="{{route('admin.about')}}">
                    <i class="fa fa-fw fa-info"></i>
                    <span class="nav-link-text">{{Lang::get('admin/nav.about')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown line">
                <form action="Language" method="post" id="langSwitcher">
                    <div class="form-group">
                        <select name="locale" onchange='this.form.submit();' class="form-control">
                            <option value="en" {{ App::getLocale() == 'en' ? ' selected' : '' }}>English</option>
                            <option value="pl" {{ App::getLocale() == 'pl' ? ' selected' : '' }}>Polski</option>
                        </select>
                        {{csrf_field()}}
                    </div>
                </form>
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
                                           'placeholder'=>Lang::get('admin/search.searchPlacehold')]) !!}
               {!! Form::submit(Lang::get('admin/search.search'),
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