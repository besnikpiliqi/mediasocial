<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\User;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(100)->create();
        // $faker = Faker::create();
        // for ($i=0; $i < 100; $i++) { 
        //     Post::create([
        //         'user_id' => User::inRandomOrder()->first()->id,
        //         'content' => $faker->paragraph(),
        //         'photo'=> '/storage/posts//dhVMouLxaHGSFItbgCYjX5coenlPPCSsBazvB9Ns.jpg',
        //     ]);
        // }
       
    }
}
