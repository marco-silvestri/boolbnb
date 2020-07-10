{{-- <div class="row container-margin">
    <div class="col-12">
        <div class="map-container">
          <iframe width="100%" height="200" frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDDdTa4Rc01xKmqdHC8SOVLoGyJ9mBAYmE&amp&q={{$apartment->address}}&center={{ $apartment->geoloc->lat }},{{ $apartment->geoloc->long }}">
          </iframe>
        </div>
    </div>
</div>   --}}


<div id="map"></div>

<style>
    #map{
        height: 350px;
        width: 450px;
    }
</style>


<script>
    var map = L.map("map",{ zoomControl: false })
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