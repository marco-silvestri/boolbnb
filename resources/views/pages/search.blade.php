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
                <input type="number" class="form-control" id="roomNumber" min="1" max="10" placeholder="Stanze">
                <label for="bathroomNumber">Numero minimo di bagni:</label>
                <input type="number" class="form-control" id="bathroomNumber" min="1" max="5" placeholder="Bagni">
                <label for="bedNumber">Numero minimo letti:</label>
                <input type="number" class="form-control" id="bedNumber" min="1" max="10" placeholder="Letti">
                <label for="squareMeter">Numero minimo di metri quadri:</label>
                <input type="number" class="form-control" id="squareMeter" min="20" max="300"placeholder="Metri quadri">
                <label for="volumeKm">Distanza:</label>
                <input type="range" id="rangeKm" name="rangeKm" min="1" max="50" value="20" step="1"> 
                <span id="rangeKmPrint"></span>
                <span>Km</span>
                {{-- Checkboxes for options --}}
                @foreach ($options as $option)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="option" id="box{{ $option->name }}" value="{{ $option->name }}">
                        <label class="form-check-label" for="box{{ $option->name }}">{{ $option->name }}</label>
                    </div>    
                @endforeach
                
            </div>
        </div>
    </div>

    {{-- Handlebars will be printed here --}}
    @include('shared.components.Search-result')

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
            var inputBed = $('#bedNumber');
            var inputSurface = $('#squareMeter');
            var inputRange = $('#rangeKm');
            var rangeLabel = $('#rangeKmPrint');
            var checkBoxes = $("input[name='option']");

            // Pack functions args, latLong passed with Blade synthax
            var geoArgs = {
                'lat' : parseFloat('{{ $latLong['lat'] }}'),
                'long' : parseFloat('{{ $latLong['lng'] }}'),
                'radius' : inputRange.val()*1000,
                'conditions' : [0, 0, 0, 0],
            };

            var printArgs = {
                'template' : template,
                'context' : context,
            };

            var options = [];

            // Query and print on load
            geoSearch(geoArgs, printArgs, options);
            var radiusKm = geoArgs.radius/1000;
            rangeLabel.html(radiusKm);

            // Query and print on params change
            inputRoom.on('change', function() {
                geoArgs.conditions[0] = inputRoom.val(); 
                geoSearch(geoArgs, printArgs, options);
            });

            inputBathroom.on('change', function() {
                geoArgs.conditions[1] = inputBathroom.val();
                geoSearch(geoArgs, printArgs, options);
            });

            inputBed.on('change', function() {
                geoArgs.conditions[2] = inputSurface.val();
                geoSearch(geoArgs, printArgs, options);
            });

            inputSurface.on('change', function() {
                geoArgs.conditions[3] = inputSurface.val();
                geoSearch(geoArgs, printArgs, options);
            });

            //Query and print on range change
            inputRange.on('change', function() {
                geoArgs.radius = inputRange.val()*1000
                geoSearch(geoArgs, printArgs, options);
            });

            //Range update label
            inputRange.on('input', function() {
                geoArgs.radius = inputRange.val()*1000
                radiusKm = geoArgs.radius/1000;
                rangeLabel.html(radiusKm);
            });

            //Read the checkboxes values and query
            checkBoxes.click(function() {
                var checked = $(this).val();
                if ($(this).is(':checked')) {
                    options.push(checked);
                } else {
                    options.splice($.inArray(checked, options),1);
                    console.log(options.sort());
                    
                };
                geoSearch(geoArgs, printArgs, options);
            });

    });//End of Doc Ready

        //Search and print
        function geoSearch(geoArgs, print, options){
            var lat = geoArgs.lat;
            var long = geoArgs.long;
            var radius = geoArgs.radius;
            var condition = geoArgs.conditions;
            var template = print.template;
            var context = print.context;
            const client = algoliasearch('4FF6JXK2K0', '86e9c61811af66cf6fc6209ec6715464');
            const index = client.initIndex('apartments');
            index.search('', {
                aroundLatLng : lat +','+ long, 
                aroundRadius : radius,
            }).then(({ hits }) => {
                var data = JSON.stringify(hits);
                cleanAll(context);
                if (options.length != 0){
                    for (var i = 0; i<data.length; i++){
                        if (_.isEqual(options.sort(),hits[i]['options'].sort())){
                            printCard(data, template, context, i, condition)
                        }
                    }
                }
                else if (options.length == 0){
                    var templateData = {
                        alert: 'Seleziona dei servizi aggiuntivi!'
                    };
                    var output = template(templateData);
                    context.append(output);
                }
            });
        }

        //Clean the area
        function cleanAll (destination){
            destination.html('');
        }
        //Print with Handlebars
        function printCard(data, template, destination, index, condition){
            var thisCard = JSON.parse(data)[index];
            if (thisCard['room_numbers'] >= condition[0] &&
                thisCard['bathrooms'] >= condition[1] &&
                thisCard['beds'] >= condition[2] &&
                thisCard['square_meters'] >= condition[3]){
            var templateData = {
                cardName: thisCard['name'],
                cardDescription: thisCard['description'],
                cardOptions: thisCard['options'],
                imgConstructor: '<img src="/storage/'+ thisCard['img'] + '" alt="">',
                routeConstructor: '<a href="/user/apartment/'+ thisCard['id'] +'">Visualizza</a>',
                };
            var output = template(templateData);
            destination.append(output);
            }
        }

    </script>
@endsection
