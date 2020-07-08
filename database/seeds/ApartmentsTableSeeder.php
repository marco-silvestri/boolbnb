<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( Faker $faker)
    {
        // Apartment::truncate();
        $users = User::all();

        for ($i = 0; $i < 10; $i++) {
            $name = 'Apartment' . ' ' . $faker->word();

            $newApartment = new Apartment();

            $newApartment->user_id = $users->random()->id;
            $newApartment->name = $name;
            $newApartment->description = $faker->text(200);
            $newApartment->slug = Str::slug($name, '-');
            $newApartment->room_numbers = $faker->numberBetween(2, 6);
            $newApartment->bathrooms = $faker->numberBetween(1, 3);
            $newApartment->beds = $faker->numberBetween(2, 6);
            $newApartment->square_meters = $faker->numberBetween(70, 300);
            $newApartment->address = $faker->address();
            $newApartment->img = $faker->imageUrl(200, 200);
            $newApartment->visibility = true;
            $newApartment->sponsorship_expiration = null;

            $newApartment->save();

        }
    }
}
