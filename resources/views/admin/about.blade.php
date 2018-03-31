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
            Mirek handlarz v1.0
        </div>
        <div class="m-b-md">
           Zapraszam do zgłaszania sugesti i bugów - pisałem to 5 dni, póki mi się darmowa licencja na php storma nie skończyła :)
           <br><b>w przyszłości:</b>
            <ul>
                <li>waluty tranzakcji</li>
                <li>Panel do wystawiania ogłoszeń</li>
                <li>Ogłoszenia na stronie głównej</li>
                <li>Przydzielanie osób odpowiedzialnych za dane auto</li>
                <li>Panel ustawień</li>
                <li>Tłumaczenie na angielski</li>
            </ul>
        </div>

        <div class="links">
            <a href="http://mzielinski.pl">Strona autora</a>
            <a href="https://github.com/zielu92/mirek-handlarz">GitHub</a>
            <a href="https://github.com/laravel/laravel">based on Laravel</a>
        </div>
    </div>
@endsection
