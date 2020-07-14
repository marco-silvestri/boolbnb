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
        $jsonData = json_encode($apartments);
        return view('pages.index', compact('apartments', 'jsonData'));
    }

    public function show(Apartment $apartment)
    {
        if (empty($apartment)) {
            abort('404');
        }

        return view('pages.guest.show', compact('apartment'));
    }

    public function searchApartment(Request $request){
        
        //Invoke helper geoCode
        $latLong = geoCode('plZON97PJS4T', 
        '485e6334a610b0b3d89ac65d5c4ca0a4', 
        $request);

        $lat = $latLong['lat'];
        $lng = $latLong['lng'];
        $radius = 50000;
        
        //Invoke helper geoSearch
        $apartments = geoSearch($lat, $lng, $radius);
        $jsonData = json_encode($apartments);
        return view('pages.search', compact('apartments', 'jsonData'));
    }
}

