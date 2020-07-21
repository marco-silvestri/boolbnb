<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;
use App\Apartment;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();
        
        for ($i = 1; $i < 30; $i++) {
            $newMessage = new Message();
            $now = Carbon::now();
            $newMessage->apartment_id = $apartments->random()->id;
            $newMessage->email = $faker->email;
            $newMessage->title = $faker->word;
            $newMessage->body = $faker->paragraph;

            $newMessage->save();
        }
    }
}
