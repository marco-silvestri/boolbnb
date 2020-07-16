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
        $apartments = Apartment::orderBy('id', 'desc')->paginate(20);
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
        
        //Invoke helper geoSearch
        $apartments = geoSearch($latLong['lat'], $latLong['lng'], 20000);
        return view('pages.search', compact('apartments', 'latLong'));
    }
}

