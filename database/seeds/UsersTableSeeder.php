<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $users = [
            [
                'name' => 'name1',
                'surname' => 'surname1',
                'email' => 'email1@gmail.com',
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '1993'),
                'email_verified_at' => now(),
                'password' => Hash::make('prova'),
            ],
            [
                'name' => 'name2',
                'surname' => 'surname2',
                'email' => 'email2@gmail.com',
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '1983'),
                'email_verified_at' => now(),
                'password' => Hash::make('prova'),
            ],
            [
                'name' => 'name3',
                'surname' => 'surname3',
                'email' => 'email3@gmail.com',
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '1973'),
                'email_verified_at' => now(),
                'password' => Hash::make('prova'),
            ],
        ];

        foreach ($users as $user) {
            $newUser = new User();

            $newUser->name = $user['name'];
            $newUser->surname = $user['surname'];
            $newUser->email = $user['email'];
            $newUser->date_of_birth = $user['date_of_birth'];
            $newUser->email_verified_at = $user['email_verified_at'];
            $newUser->password = $user['password'];

            $newUser->save();

        }
    }
}
