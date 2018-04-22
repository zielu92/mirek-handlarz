<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mirek handlarz</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
                display: inherit;
            }

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

            #langSwitcher {
                margin-top:-5px;
            }
            .lang{
                width: 100%;
                padding: 5px 20px;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ url('/admin') }}">Admin</a>
                    @else
                        <a href="{{ route('login') }}">{{Lang::get('userForm.login')}}</a>
                        <a href="{{ route('register') }}">{{Lang::get('userForm.register')}}</a>
                    @endauth
                        <form action="Language" method="post" id="langSwitcher">
                            <div class="input-group">
                                <select name="locale" onchange='this.form.submit();' class="">
                                    <option value="en" {{ App::getLocale() == 'en' ? ' selected' : '' }}>English</option>
                                    <option value="pl" {{ App::getLocale() == 'pl' ? ' selected' : '' }}>Polski</option>
                                </select>
                                {{csrf_field()}}
                            </div>
                        </form>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Mirek handlarz v1.0
                </div>

                <div class="links">
                    <a href="https://github.com/zielu92/mirek-handlarz">GitHub</a>
                    <a href="https://github.com/laravel/laravel">based on Laravel</a>
                </div>
            </div>
        </div>
    </body>
</html>
