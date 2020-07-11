<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('pages.index', compact('apartments'));
    }

    public function show(Apartment $apartment)
    {
        if (empty($apartment)) {
            abort('404');
        }

        return view('pages.guest.show', compact('apartment'));
    }

    public function searchApartment(Request $request){
        
    $appId = 'plZON97PJS4T';
    $apiKey = '485e6334a610b0b3d89ac65d5c4ca0a4';

    $places = \Algolia\AlgoliaSearch\PlacesClient::create($appId, $apiKey);
    $data = $request->all();
    
    //Query the Algolia DB to get a geoc oded address
    $result = $places->search($data['address']);
    
    //Return the result and filter to get the lat/long
    $latLong = $result['hits'][0]['_geoloc'];
    $lat = $latLong['lat'];
    $lng = $latLong['lng'];
    $radius = 20000; //20km
    
    $apartments = Apartment::search()
        ->with([
            'aroundLatLng' => $lat . ',' . $lng ,
            'aroundRadius' => $radius,
        ])->get();

    return view('pages.index', compact('apartments'));
    }
}
