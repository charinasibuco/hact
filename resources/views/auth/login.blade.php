<!DOCTYPE html>
<html>
    <head>
        <title>HACT (HIV and AIDS Core Team)</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/foundation.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
        <script type="text/javascript" src="{{ asset('js/jquery/jquery-1.11.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/foundation.min.js') }}"></script>
    </head>
    <body>
        <div id="login_bg">
            <img src="{{ asset('img/login_bg.jpg') }}" class="stretch" />
        </div>
       <br /><br /><br />

      <div class="row">
        
        <div class="large-2 columns">&nbsp;</div>
        
        <div class="large-8 columns">
            <div class="panel text-center login-header"><h5>WELCOME</h5></div>
            <div class="panel">
                <div class="row">
                    <div class="large-4 column text-center">
                        <br /><br />
                        <a class="th" href="#">
                            <img src="{{ asset('img/login_logo.jpg') }}" width="153px" />
                        </a>
                    </div>
                    <div class="large-8 column">
                        @include('hact.messages.success')
                        @include('hact.messages.error')
                        <br /><br />
                        <form action="{{ route('login_auth') }}" method="post">
                            <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                            <input type="password" id="password" name="password" placeholder="Password" />
                            {!! csrf_field() !!}
                            <button class="button alert">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="large-2 columns">&nbsp;</div>

      </div>

    </body>
</html>