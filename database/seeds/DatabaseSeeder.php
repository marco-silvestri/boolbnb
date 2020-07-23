<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ApartmentsTableSeeder::class,
            MessagesTableSeeder::class,
            OptionsTableSeeder::class,
            SponsorshipsTableSeeder::class,
        ]);
    }
}
