<?php

use Illuminate\Database\Seeder;
use App\Option;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                'name' => 'Wi-Fi',
                'icon' => 'fas fa-wifi'
            ],
            [
                'name' => 'Parking',
                'icon' => 'fas fa-parking'
            ],
            [
                'name' => 'Pool',
                'icon' => 'fas fa-swimming-pool'
            ],
            [
                'name' => 'Reception',
                'icon' => 'fas fa-concierge-bell'
            ],
            [
                'name' => 'Sauna',
                'icon' => 'fas fa-spa'
            ],
            [
                'name' => 'Seascape',
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
