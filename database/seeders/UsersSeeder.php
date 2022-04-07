<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = [
            ['name' => 'Best Property', 'phone' => $faker->phoneNumber(), 'email' => '', 'role' => 'admin', 'password' => Hash::make('!teHr?560.'), 'status' => 'active'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        if(env('APP_ENV') !== 'production') {
            User::factory()->count(312)->create();
        }
    }
}
