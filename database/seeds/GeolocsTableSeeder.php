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
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();

        for ($i = 0; $i < 100 ; $i++) {
            $newGeoloc = new Geoloc();

            $newGeoloc->apartment_id = $apartments->random()->id;
            $newGeoloc->lat = $faker->latitude;
            $newGeoloc->long = $faker->longitude;

            $newGeoloc->save();

        }
    }
}
