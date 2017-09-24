@if(Session::has('status'))
    <div class="alert-box success">
        {{ Session::get('status') }}
        <a href="#" class="close">&times;</a>
    </div>
@endif