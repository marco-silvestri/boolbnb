<div id="map"></div>

<script>
    var map = L.map("map",{ zoomControl: false })
    .setView([{{ $apartment->lat }}, {{ $apartment->long }}], 18);

    map.dragging.disable();
    map.touchZoom.disable();
    map.doubleClickZoom.disable();
    map.scrollWheelZoom.disable();
    map.boxZoom.disable();
    map.keyboard.disable();

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $apartment->lat }}, {{ $apartment->long }}]).addTo(map);
</script>