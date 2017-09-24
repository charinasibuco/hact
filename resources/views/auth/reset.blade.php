<!DOCTYPE html>
<html>
    @include('web.header')
    <body>
       @include('web.navigation')
      <div class="container-fluid">
        <div class="row">
           <div class="col-md-8 col-md-offset-2">
             <div class="panel panel-default" style="margin-top:50px">
              <div class="panel-heading">Reset Password</div>
               <div class="panel-body">

                 @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="/password/reset">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="token" value="{{ $token }}">

                  <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" style="border: #DDDDDD 1px solid;">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                    <input type="password" class="form-control" name="password" style="border: #DDDDDD 1px solid;">
                    </div>
                   </div>

                   <div class="form-group">
                     <label class="col-md-4 control-label">Confirm Password</label>
                     <div class="col-md-6">
                     <input type="password" class="form-control" name="password_confirmation" style="border: #DDDDDD 1px solid;">
                     </div>
                    </div>
                    {!! csrf_field() !!}
                   <div class="form-group">
                     <div class="col-md-6 col-md-offset-4">
                       <button type="submit" class="btn btn-primary">
                                   Reset Password
                       </button>
                     </div>
                   </div>
                 </form>

               </div>
             </div>
           </div>
         </div>
      </div>
    </body>
</html>