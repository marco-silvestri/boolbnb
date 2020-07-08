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
            'Wi-Fi',
            'Parking',
            'Pool',
            'Reception',
            'Sauna',
            'Seascape'
        ];

        foreach ($options as $option) {
            $newOption = new Option();
            $newOption->name = $option;

            $newOption->save();
        }

    }
}
