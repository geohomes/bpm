<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(MembershipsSeeder::class);

        if(env('APP_ENV') !== 'production') {  
            $this->call(PropertiesSeeder::class);

            $this->call(BlogsSeeder::class);
            $this->call(MaterialsSeeder::class);
            $this->call(PaymentsSeeder::class);

            $this->call(SubscriptionsSeeder::class);
            $this->call(NewsSeeder::class);
            $this->call(UnitsSeeder::class);
            $this->call(CreditsSeeder::class);
            
            $this->call(ReviewsSeeder::class);
            $this->call(ServicesSeeder::class);
            $this->call(AdvertsSeeder::class);
            $this->call(ProfilesSeeder::class);
            $this->call(SocialsSeeder::class);
        }
    }
}
