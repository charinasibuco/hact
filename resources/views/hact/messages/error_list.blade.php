@if(count($errors) > 0)
    <div class="alert-box alert">
        <ul class="no-bullet">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <a href="#" class="close">&times;</a>
    </div>
@endif