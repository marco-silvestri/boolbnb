<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Geoloc;
use App\Apartment;

class GeolocsTableSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $geolocApartments = [
            [
                'apartment_id' => 1,
                'lat' => 45.4698,
                'long' => 9.196847,
            ],
            [
                'apartment_id' => 2,
                'lat' => 41.908905,
                'long' => 12.479232,
            ],
            [
                'apartment_id' => 3,
                'lat' => 41.125520,
                'long' => 16.870646,
            ],
            [
                'apartment_id' => 4,
                'lat' => 45.066338,
                'long' => 7.693589,
            ],
            [
                'apartment_id' => 5,
                'lat' => 43.732380,
                'long' => 11.216522,
            ],
            

        ];
        
        
        foreach ($geolocApartments  as $geolocApartment ) {
            $newGeoloc = new Geoloc();
            $newGeoloc->apartment_id = $geolocApartment['apartment_id'];
            $newGeoloc->lat = $geolocApartment['lat'];
            $newGeoloc->long = $geolocApartment['long'];
            $newGeoloc->save();
        }


    }
}
