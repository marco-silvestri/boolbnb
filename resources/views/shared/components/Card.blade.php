<div class="col-sm-3">
    <div class="card">
        <div class="card-body">
            <img class="card-img-top" src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
            <h5 class="card-title">{{ $apartment->name }}</h5>
            <p class="card-text">{{ $apartment->description }}</p>
            <div id="map{{ $loop->iteration }}"></div>
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


<style>
    #map{{ $loop->iteration }}{
        height: 150px;
        width: 200px;
    }
</style>




<script>
    var map = L.map("map{{ $loop->iteration }}",{ zoomControl: false })
    .setView([{{ $apartment->geoloc->lat }}, {{ $apartment->geoloc->long }}], 18);

    map.dragging.disable();
    map.touchZoom.disable();
    map.doubleClickZoom.disable();
    map.scrollWheelZoom.disable();
    map.boxZoom.disable();
    map.keyboard.disable();

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $apartment->geoloc->lat }}, {{ $apartment->geoloc->long }}]).addTo(map);
</script>