<?php

use App\Apartment;

//Geocode
if(!function_exists('geoCode')){
    function geoCode($appId, $apiKey, $request){
        $places = \Algolia\AlgoliaSearch\PlacesClient::create($appId, $apiKey);

        if(!is_string($request)){
            $data = $request->all();
            // /Query the Algolia DB to get a geocoded address
             $result = $places->search($data['address']);
        }else{
            $result = $places->search($request);
        }

        //Return the result and filter to get the lat/long
        return $result['hits'][0]['_geoloc'];
    }
}

//Geo search
if(!function_exists('geoSearch')){
    function geoSearch($lat, $lng, $radius){
        $apartments = Apartment::search()
            ->with([
                'aroundLatLng' => $lat . ',' . $lng ,
                'aroundRadius' => $radius,
            ])->get();
        return $apartments;
    }
}

?>
