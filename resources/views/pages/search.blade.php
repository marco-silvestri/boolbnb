@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="container">
        <div class="search-page">

            <h1>Pagina di ricerca</h1>
            
            <form action="{{ route('guest.search') }}" method="POST">
                @csrf
                @method('POST')
                <input type="text" name="address" id="address-input" placeholder="Trova un appartamento...">
                <input class="submit" type="submit" value="Cerca">
            </form>
    
            <div class="form-group services">
    
                <div class="range">
                    <input type="range" id="rangeKm" name="rangeKm" min="1" max="50" value="20" step="1"> 
    
                    <div class="range-span">
                        <span id="rangeKmPrint"></span>
                    <span>Km</span>
                    </div>
                </div>
    
                <div class="services-input">
                    <input type="number" class="form-control" id="roomNumber" min="1" max="10" placeholder="Stanze">             
                    <input type="number" class="form-control" id="bedNumber" min="1" max="10" placeholder="Letti">
                </div>
            
                <div class="options">
                    
                    @foreach ($options as $option)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="option" id="box{{ $option->name }}" value="{{ $option->name }}">
                            <label class="form-check-label" for="box{{ $option->name }}">{{ $option->name }}</label>
                        </div>    
                    @endforeach
                </div>
    
            </div>
        </div>
    </div>

    <div class="sponsored">
        <section class="vetrina">
            <div class="container">
                <h2>Appartamenti in Evidenza</h2>
                <div class="row apartment d-flex flex-wrap">
                    @foreach ($sponsoredApartments as $apartment)
                        @include('shared.components.Card')
                    @endforeach
                </div>
            </div>
        </section>
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
            var container= $('.search-apt');
            var context = $('#context');
            var inputRoom = $('#roomNumber');
            var inputBed = $('#bedNumber');
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
                'container' : container,
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

            inputBed.on('change', function() {
                geoArgs.conditions[1] = inputBed.val();
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
            //Build the query and instantiate algolia
            var query = queryBuilder(options, geoArgs.conditions);
            const client = algoliasearch('4FF6JXK2K0', '86e9c61811af66cf6fc6209ec6715464');
            const index = client.initIndex('apartments');
            index.search('', {
                aroundLatLng : geoArgs.lat +','+ geoArgs.long, 
                aroundRadius : geoArgs.radius,
                filters: query,
            }).then(({ hits }) => {
                //If there are no results, alert the user
                if (hits.length == 0){
                    cleanAll(print.context);
                    var templateData = {
                        alert: '<span>Nessun risultato</span>'
                    };
                    var output = print.template(templateData);
                    print.context.append(output);
                } else {
                    //Parse the JSON for Script processing
                    var data = JSON.stringify(hits);
                    //Check if there are options selected
                    if (options.length != 0){
                        cleanAll(print.context);
                        for (var i = 0; i< (data.length-1) ; i++){
                            printCard(data, print.template, print.context, i);
                        }
                    }
                    //If no options are selected, alert the user
                    else if (options.length == 0){
                        cleanAll(print.context);
                        var templateData = {
                            alert: '<span>Seleziona dei servizi aggiuntivi!</span>'
                        };
                        var output = print.template(templateData);
                        print.context.append(output);
                    }
                    console.log(options.length);
                }
            });
        }

        //Query builder
        function queryBuilder(options, conditions){
            var query = ""; 
            options.forEach(option => {
                if (query == ""){
                    query += '(options:' + option;
                }
                else {
                    query += ' OR options:' + option;
                }
            });
            if (query == ""){
                query = 'room_numbers >=' + conditions[0] + ' AND beds >=' + conditions[1];
            } else {
                query += ') AND ('+ 'room_numbers >=' + conditions[0] + ' AND beds >=' + conditions[1] +')';
            }
            return query;
        }

        //Clean the area
        function cleanAll (destination){
            destination.html('');
            
        }

        //Print with Handlebars
        function printCard(data, template, destination, index){
            var card = JSON.parse(data)[index];
            var templateData = {
                cardName: card['name'],
                cardDescription: card['description'],
                cardOptions: card['options'],
                imgConstructor: '<img src="/storage/'+ card['img'] + '" alt="">',
                routeConstructor: '<a href="/guest/apartment/'+ card['id'] +'">Visualizza</a>',
                };
            var output = template(templateData);
            destination.append(output);
            //}
        }
    </script>
@endsection
