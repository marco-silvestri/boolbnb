<div class="message-box">
    <form action="{{route('message.store')}}" method="POST">
        @csrf
        @method('POST')
        <div>

            <h4 class="mb-3">Contatta l'Host</h4>
        </div>
        <div class="form-group">
            
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
            
            <input type="title" class="form-control" id="title" name="title" placeholder="Inserisci titolo">
        </div>

        <div class="form-group">
            <textarea id="body" class="form-control" name="body" rows="5" placeholder="Scrivi un messaggio per l'host dell'appartamento"></textarea>
        </div>           

        <div class="submit">
            <input class ="btn btn-info" type="submit" value="Invia">
        </div>
    </form>
</div>