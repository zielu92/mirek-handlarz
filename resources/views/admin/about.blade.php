@extends('admin.layout.admin')
@section('styles')

    <!-- Fonts -->
    <style>
        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        ul {
            list-style: none;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="title m-b-md">
            {{Lang::get('about.about')}}
        </div>
        <div class="m-b-md col-md-6 offset-md-3">
            {{Lang::get('about.infoAbout')}}
        </div>
        <div class="m-b-md">
            <b>{{Lang::get('about.future')}}:</b>
            <ul>
                <li>{{Lang::get('about.future1')}}</li>
                <li>{{Lang::get('about.future2')}}</li>
                <li>{{Lang::get('about.future3')}}</li>
            </ul>
            <br>
            {{Lang::get('about.infoSuggestion')}}
        </div>

        <div class="links">
            <a href="http://mzielinski.pl">{{Lang::get('about.authorPage')}}</a>
            <a href="https://www.paypal.me/zielu92">PayPal</a>
            <a href="https://github.com/zielu92/mirek-handlarz">GitHub</a>
            <a href="https://github.com/laravel/laravel">{{Lang::get('about.based')}}</a>
        </div>
    </div>
@endsection
