<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Payment;
use App\Option;
use Carbon\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::orderBy('created_at', 'desc')->paginate(6);
        $sponsoredApartments = Apartment::where('sponsorship_expiration', '>', Carbon::now())->get();
        
        
        return view('pages.index', compact('apartments','sponsoredApartments'));

    }

    public function show(Apartment $apartment)
    {
        if (empty($apartment)) {
            abort('404');
        }



        return view('pages.show', compact('apartment'));
    }

    public function searchApartment(Request $request){
        
        $sponsoredApartments = Apartment::where('sponsorship_expiration', '>', Carbon::now())->get();

        //Invoke helper geoCode
        $latLong = geoCode('plZON97PJS4T', 
        '485e6334a610b0b3d89ac65d5c4ca0a4', 
        $request);
        
        //Get all options
        $options = Option::all();

        //Invoke helper geoSearch
        $apartments = geoSearch($latLong['lat'], $latLong['lng'], 20000);
        return view('pages.search', compact('apartments', 'latLong', 'options','sponsoredApartments'));
    }

    public function searchCity(Request $request){
        
        //Invoke helper geoCode
        $latLong = geoCode('plZON97PJS4T', 
        '485e6334a610b0b3d89ac65d5c4ca0a4', 
        $request['cityName']);

        $cityName = $request['cityName'];
        //Invoke helper geoSearch
        $apartments = geoSearch($latLong['lat'], $latLong['lng'], 20000);
        $firstApartments = fourGeoSearch($latLong['lat'], $latLong['lng'], 20000);
        return view('pages.city', compact('apartments', 'cityName' , 'firstApartments'));
    }

    

}

