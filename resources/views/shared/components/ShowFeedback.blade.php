 @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('hasSaved'))
    <div class="alert alert-success">
        <p>Messaggio inviato con successo</p>
    </div>
@endif