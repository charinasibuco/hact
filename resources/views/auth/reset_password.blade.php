<!DOCTYPE html>
<html>
    <head>
        <title>HACT (HIV and AIDS Core Team)</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/foundation.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
        <script type="text/javascript" src="{{ asset('js/jquery/jquery-1.11.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/foundation.min.js') }}"></script>
    </head>
    <body>
       
  
      <div class="row">
        
        @include('hact.messages.success')
        @include('hact.messages.error_list')

        <div class="large-12 columns">
            <form action="{{ route('reset_password') }}" method="post">
                <input type="password" id="password" name="password" placeholder="Password" />
                <input type="password" id="password_again" name="password_again" placeholder="Password Again" />
                {!! csrf_field() !!}
                <button class="button button-small button-primary">Login</button>
            </form>
        </div>
      </div>
      
       
    </body>
</html>