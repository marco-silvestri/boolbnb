@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="container">
        <div class="row justify-content-center">
            <h1>Pagina di ricerca</h1>
        </div>

        <form action="{{ route('guest.search') }}" method="POST">
            @csrf
            @method('POST')
            <input type="text" name="address" id="address-input" placeholder="Trova un appartamento... o lascia il campo vuoto per trovare appartamenti intorno a te">
            <input type="submit" value="Cerca">
        </form>

        <div class="container">
            <div class="form-group">
                <label for="roomNumber">Numero minimo stanze:</label>
                <input type="number" class="form-control" id="roomNumber" placeholder="Stanze da letto">
                <label for="bathroomNumber">Numero minimo di bagni:</label>
                <input type="number" class="form-control" id="bathroomNumber" placeholder="Bagni">
                <label for="squareMeter">Numero minimo di metri quadri:</label>
                <input type="number" class="form-control" id="squareMeter" placeholder="Metri quadri">
            </div>
        </div>
    </div>

    <div id="context">
    </div>

    <script id="card-template" type="text/x-handlebars-template">
        <div class="container">
                <h1> @{{ cardName }}</h1>
                <p> @{{ cardDescription }}</p>
        </div>
    </script>

    {{-- Parsing the JSON from the controller and passing it to a JS variable --}}
    <script type="text/javascript">
        
        $(document).ready(function () {

            // Handlebars refs
            var source = $('#card-template').html();
            var template = Handlebars.compile(source);

            // jQuery refs
            var context = $('#context');
            var inputRoom = $('#roomNumber');
            var inputBathroom = $('#bathroomNumber');
            var inputSurface = $('#squareMeter');
            
            var condition = [0, 0, 0];
            var lat = '{{ $latLong['lat'] }}';
            var long =  '{{ $latLong['lng'] }}';
            var radius = 20000;

            geoSearch(parseFloat(lat), 
                    parseFloat(long), 
                    radius, 
                    template, 
                    context, 
                    condition);

            
            inputRoom.on('input', function() {
                condition[0] = inputRoom.val();
                console.log(condition);
                cleanAll(context);
                    geoSearch(parseFloat(lat), 
                    parseFloat(long), 
                    radius, 
                    template, 
                    context, 
                    condition);
            });

            inputBathroom.on('input', function() {
                condition[1] = inputBathroom.val();
                console.log(condition);
                cleanAll(context);
                    geoSearch(parseFloat(lat), 
                    parseFloat(long), 
                    radius, 
                    template, 
                    context, 
                    condition);
            });

            inputSurface.on('input', function() {
                condition[2] = inputSurface.val();
                console.log(condition);
                cleanAll(context);
                    geoSearch(parseFloat(lat), 
                    parseFloat(long), 
                    radius, 
                    template, 
                    context, 
                    condition);
            });
    });

        //Search
        function geoSearch(lat, long, radius, template, context, condition ){
            const client = algoliasearch('4FF6JXK2K0', '86e9c61811af66cf6fc6209ec6715464');
            const index = client.initIndex('apartments');
            index.search('', {
                aroundLatLng : lat + ',' + long, 
                aroundRadius : radius,
            }).then(({ hits }) => {
                var data = JSON.stringify(hits);
                for (var i = 0; i<data.length; i++){
                    printCard(data, template, context, i, condition)
                }   
            });
        }


        function cleanAll (destination){
            destination.html('');
        }

        function printCard(data, template, destination, index, condition){
            var thisCard = JSON.parse(data)[index];
            if (thisCard['beds'] >= condition[0] &&
                thisCard['bathrooms'] >= condition[1] &&
                thisCard['square_meters'] >= condition[2]){
            var templateData = {
                cardName: thisCard['name'],
                cardDescription: thisCard['description'],
                };
            var output = template(templateData);
            destination.append(output);
            }
        }

    </script>
@endsection
