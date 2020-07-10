<div class="col-sm-3">
    <div class="card">
        <div class="card-body">
            
            <h5 class="card-title">{{ $apartment->name }}</h5>
            <p class="card-text">{{ $apartment->description }}</p>
            @guest       
            {{-- Conditional redirect to Guest Show --}}
            <a href="{{route('guest.apartment.show', $apartment->id)}}">show guest</a>
            @else
                {{-- Conditional redirect to User Owner --}}
                <a href="{{route('user.apartment.show', $apartment->id)}}" 
                    @if ($apartment->user_id == Auth::id())
                        class="btn btn-warning"> Modifica inserzione
                    @else
                        {{-- Conditional redirect to User --}}
                        class="btn btn-primary"> Visualizza dettagli
                    @endif
                </a>
            @endguest
            
        </div>
    </div>
</div>
