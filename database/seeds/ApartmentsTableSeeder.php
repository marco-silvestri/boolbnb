<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ApartmentsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $newApartment = new Apartment();
            $users = User::all();
            $name = $faker->streetName();
            $address=$faker->stateAbbr(); 

            $newApartment->user_id = $users->random()->id;
            $newApartment->name = $name;
            $newApartment->description = $faker->text($maxNbChars = 150);
            $newApartment->slug = Str::slug($name, '-');
            $newApartment->room_numbers = $faker->randomDigitNotNull($max = 20);
            $newApartment->bathrooms  = $faker->randomDigitNotNull($max = 20);
            $newApartment->beds = $faker->randomDigitNotNull($max = 20);
            $newApartment->square_meters = $faker->randomDigitNotNull($max = 20);
            $newApartment->address = $address; 
            $newApartment->img = 1;
            $newApartment->visibility = true;
            $newApartment->sponsorship_expiration = null;

            $latLong= geoCode('plZON97PJS4T' , '485e6334a610b0b3d89ac65d5c4ca0a4' , $address);
            $newApartment->lat =  $latLong['lat'];
            $newApartment->long = $latLong['lng'];

            $newApartment->save();
        }
        // MANUALLY ADDED
        // $Apartments = [
        //     [
        //         'user_id' => 1,
        //         'name' => 'Intero bilocale tra Bergamo e Milano',
        //         'description' => 'bilocale di nuovissima costruzione, ideale per due persone, con la Possibilità di aggiungere un terzo posto letto. Situato a piano terra, luminoso e con un piccolo giardino privato in cui è possibile cenare ed utilizzare il barbecue. Cucina attrezzata con forno, forno a microonde, piano cottura ad induzione, bagno con ampia doccia e una camera con letto matrimoniale.',
        //         'room_numbers' => 3,
        //         'bathrooms' => 1,
        //         'beds' => 2,
        //         'square_meters' => 150,
        //         'address' => 'Corso Europa 16, Milano (MI)',
        //         'lat' => 45.4698,
        //         'long' => 9.196847,
        //         'img' => 'https://a0.muscache.com/im/pictures/871a423d-c66d-45fc-b8d0-f98718b61a1a.jpg?aki_policy=xx_large',
        //         'visibility' => true,
        //         'sponsorship_expiration' => null,
        //         'lat' => 45.46980000,
        //         'long' => 9.19684700,
        //     ],
        //     [
        //         'user_id' => 1,
        //         'name' => 'Splendido Loft Appartamento',
        //         'description' => 'Il mio loft e uno spazio ricavato in palazzo del XXVI secolo nel cuore di Roma unico e accogliente',
        //         'room_numbers' => 2,
        //         'bathrooms' => 1,
        //         'beds' => 2,
        //         'square_meters' => 50,
        //         'address' => 'Via Margutta 33, Roma (Rm)',
        //         'lat' => 41.908905,
        //         'long' => 12.479232,
        //         'img' => 'https://a0.muscache.com/im/pictures/c9db035f-7239-4b52-a8fa-b3e8622c8171.jpg?aki_policy=xx_large',
        //         'visibility' => true,
        //         'sponsorship_expiration' => null,
        //         'lat' => 41.90890500,
        //         'long' => 12.47923200,
        //     ],
        //     [
        //         'user_id' => 1,
        //         'name' => 'Vivi i colori ed i suoni di Bari',
        //         'description' => 'Il nostro è uno splendido bilocale con pietra a vista. Situato in una silenziosa e curata corte del borgo antico, assicura quiete e riservatezza. Può ospitare una coppia ,più 2 bambini o una terza persona. Posizionato a pochi passi dal centro, da antichi monumenti, chiese, musei e vita urbana anche notturna.',
        //         'room_numbers' => 2,
        //         'bathrooms' => 1,
        //         'beds' => 3,
        //         'square_meters' => 75,
        //         'address' => 'Via Nicolò Piccini 28, Bari (BA)',
        //         'lat' => 41.125520,
        //         'long' => 16.870646,
        //         'img' => 'https://a0.muscache.com/im/pictures/35597864/3702e233_original.jpg?aki_policy=x_large',
        //         'visibility' => true,
        //         'sponsorship_expiration' => null,
        //         'lat' => 41.12552000,
        //         'long' => 16.87064600,
        //     ],
        //     [
        //         'user_id' => 2,
        //         'name' => 'Lovely flat in the heart',
        //         'description' => 'Elegante monolocale nel pieno centro di Torino, sotto i portici della splendida
        //         tra Piazza Vittorio Veneto e Piazza Castello, con vista mozzafiato sulla Mole Antonelliana.',
        //         'room_numbers' => 2,
        //         'bathrooms' => 1,
        //         'beds' => 3,
        //         'square_meters' => 95,
        //         'address' => 'Via Po 95, Torino (TO)',
        //         'lat' => 45.066338,
        //         'long' => 7.693589,
        //         'img' => 'https://a0.muscache.com/im/pictures/3f4db92f-c393-484a-9b4d-7a3816fee26a.jpg?aki_policy=large',
        //         'visibility' => true,
        //         'sponsorship_expiration' => null,
        //         'lat' => 45.06633800,
        //         'long' => 7.69358900,
        //     ],
        //     [
        //         'user_id' => 2,
        //         'name' => 'Casa albero',
        //         'description' => 'Assorbi l energia della natura vivendo in questa meravigliosa casa posta su di un albero. Confortevole e vintage, panoramica e intima, ti regalerà colori e istanti indimenticabili mentre i pini che la circondano ti sussurreranno storie secolari.
        //         ',
        //         'room_numbers' => 1,
        //         'bathrooms' => 1,
        //         'beds' => 2,
        //         'square_meters' => 45,
        //         'address' => 'Via Volterrana 89, Firenze (FI)',
        //         'lat' => 43.732380,
        //         'long' => 11.216522,
        //         'img' => 'https://a0.muscache.com/im/pictures/c1ea79f7-f6ce-4cb9-939d-e6ccdcd5c0a5.jpg?aki_policy=xx_large',
        //         'visibility' => true,
        //         'sponsorship_expiration' => null,
        //         'lat' => 43.73238000,
        //         'long' => 11.21652200,
        //     ],
            
        // ];

        // foreach ($Apartments as $Apartment) {
        //     $newApartment = new Apartment();
        //     $name = $Apartment['name'];

        //     $newApartment->user_id = $Apartment['user_id'];
        //     $newApartment->name = $Apartment['name'];
        //     $newApartment->description = $Apartment['description'];
        //     $newApartment->slug = Str::slug($name, '-');
        //     $newApartment->room_numbers = $Apartment['room_numbers'];
        //     $newApartment->bathrooms  = $Apartment['bathrooms'];
        //     $newApartment->beds = $Apartment['beds'];
        //     $newApartment->square_meters = $Apartment['square_meters'];
        //     $newApartment->address = $Apartment['address'];
        //     $newApartment->lat = $Apartment['lat'];
        //     $newApartment->long = $Apartment['long'];
        //     $newApartment->img = $Apartment['img'];
        //     $newApartment->visibility = $Apartment['visibility'];
        //     $newApartment->sponsorship_expiration = $Apartment['sponsorship_expiration'];
        //     $newApartment->lat = $Apartment['lat'];
        //     $newApartment->long = $Apartment['long'];

        //     $newApartment->save();
        // }
    }

    
}
