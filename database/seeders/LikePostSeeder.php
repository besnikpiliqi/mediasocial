<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\LikePost;

class LikePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikePost::factory(1000)->create();
    }
}
