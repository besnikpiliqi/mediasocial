<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\City;
use Faker\Factory as Faker;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory(20)->create();
        // $faker = Faker::create();
        // for ($i=0; $i < 20; $i++) { 
        //     City::create([
        //         'country_id' => rand(1,5),
        //         'city'=> $faker->city,
        //     ]);
        // }
        
    }
}
