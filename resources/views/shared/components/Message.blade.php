<div class="message">
    <form action="{{route('message.store')}}" method="POST">
        @csrf
        @method('POST')
    <h2>Contatta l'utente</h2>
    <div class="form-group">
        <label for="email">Indirizzo email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci la tua e-mail" 
        value = " @guest       
            @else
                {{-- Conditional redirect to User Owner --}}
                {{Auth::user()->email}}
            @endguest"
        >
        <input type="hidden" name="currentId" id="currentId" value="{{$apartment->id}}">
    </div>

    <div class="form-group">
        <label for="title">Titolo</label>
        <input type="title" class="form-control" id="title" name="title" placeholder="Inserisci titolo">
    </div>

    <div class="form-group">
        <label for="body">Messaggio</label>
        <textarea id="body" class="form-control" name="body" value = > </textarea>
    </div>           

    <input class ="btn btn-primary" type="submit" value="Invia messaggio">
    </form>
</div>