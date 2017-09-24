@if(Session::has('error'))
    <div class="alert-box alert">
        {{ Session::get('error') }}
        <a href="#" class="close">&times;</a>
    </div>
@endif