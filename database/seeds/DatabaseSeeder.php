<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            OptionsTableSeeder::class,
            SponsorshipsTableSeeder::class,
        ]);
    }
}
