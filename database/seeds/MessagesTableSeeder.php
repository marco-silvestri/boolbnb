<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;
use App\Apartment;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Message::truncate();
        $apartments = Apartment::all();

        for ($i = 0; $i < 10; $i++) {
            $newMessage = new Message();

            $newMessage->apartment_id = $apartments->random()->id;
            $newMessage->email = $faker->email;
            $newMessage->title = $faker->word;
            $newMessage->body = $faker->paragraph;

            $newMessage->save();

        }
    }
}
