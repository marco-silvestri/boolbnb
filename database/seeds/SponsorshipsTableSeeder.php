<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;


class SponsorshipsTableSeeder extends Seeder
{
    public function run()
    {
        $packs = [
            [
            'price' => '2.99',
            'duration' => '24',
            'name' => 'Bronze'
            ],
            [
            'price' => '5.99',
            'duration' => '72',
            'name' => 'Silver'
            ],
            [
            'price' => '9.99',
            'duration' => '144',
            'name' => 'Gold'
            ]
        ];

        foreach ($packs as $pack) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->price = $pack['price'];
            $newSponsorship->duration = $pack['duration'];
            $newSponsorship->name = $pack['name'];

            $newSponsorship->save();
        }
    }
}
