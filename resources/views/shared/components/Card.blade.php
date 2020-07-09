<div class="col-sm-3">
    <div class="card">
        <div class="card-body">
            <img class="card-img-top" src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
            <h5 class="card-title">{{ $apartment->name }}</h5>
            <p class="card-text">{{ $apartment->description }}</p>
            @guest       
                @if (Route::has('register'))
                    {{-- se sei un guest, vai alla show dei guest --}}
                    <a href="{{route('guest.apartment.show', $apartment->id)}}">show guest</a>
                @endif
            @else
                {{-- se sei un user, vai alla show degli user --}}
                <a class="btn btn-primary" href="{{route('user.apartment.show', $apartment->id)}}">show user</a>
            @endguest
            <div id="map{{ $loop->iteration }}"></div>
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
    var map = L.map("map{{ $loop->iteration }}").setView([{{ $apartment->geoloc->lat }}, {{ $apartment->geoloc->long }}], 18);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $apartment->geoloc->lat }}, {{ $apartment->geoloc->long }}]).addTo(map)
        .bindPopup('Appartamento')
        .openPopup();
</script>