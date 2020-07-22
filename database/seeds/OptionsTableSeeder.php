<?php

use Illuminate\Database\Seeder;
use App\Option;

class OptionsTableSeeder extends Seeder
{
    public function run()
    {
        $options = [
            [
                'name' => 'Wi-Fi',
                'icon' => 'fas fa-wifi'
            ],
            [
                'name' => 'Parcheggio',
                'icon' => 'fas fa-parking'
            ],
            [
                'name' => 'Piscina',
                'icon' => 'fas fa-swimming-pool'
            ],
            [
                'name' => 'Portineria',
                'icon' => 'fas fa-concierge-bell'
            ],
            [
                'name' => 'Sauna',
                'icon' => 'fas fa-spa'
            ],
            [
                'name' => 'Vista mare',
                'icon' => 'fas fa-water'
            ]
        ];
        
        foreach ($options as $option) {
            $newOption = new Option();
            $newOption->name = $option['name'];
            $newOption->icon = $option['icon'];

            $newOption->save();
        }
    }
}
