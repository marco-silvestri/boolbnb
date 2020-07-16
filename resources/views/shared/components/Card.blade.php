<div class="col-sm-3 @if ($apartment->visibility == 0) d-none @endif">
    <div class="card">
        <div class="card-body ">
            @include('shared.components.Img')
            <h5 class="card-title">{{ $apartment->name }}</h5>
            <p class="card-text">{{ $apartment->description }}</p>
            @guest       
                {{-- Conditional redirect to Guest Show --}}
                <a href="{{route('guest.apartment.show', $apartment->id)}}">show guest</a>
                @else
                
                
                @if ($apartment->user_id == Auth::id())
                    <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-warning"> Modifica inserzione</a>
                @else
                    <a href="{{route('user.apartment.show', $apartment->id)}}" class="btn btn-primary"> Visualizza dettagli</a>
                @endif
            @endguest
        </div>
    </div>
</div>
