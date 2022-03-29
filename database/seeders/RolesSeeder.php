<?php

namespace Database\Seeders;
use App\Models\{User, Role};
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $faker = Faker::create();
        $roles = [
            'admin',
            'superadmin',
            'moderator',
            'blogger',
            'user',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'description' => $role['description'],
                'code' => $role['code'],
            ]);
        }
    }
}
