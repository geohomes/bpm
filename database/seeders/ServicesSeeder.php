<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Service, User};

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::truncate();
        Service::factory()->count(User::count() * 7)->create();
    }
}
