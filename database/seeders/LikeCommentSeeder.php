<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\LikeComment;

class LikeCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikeComment::factory(1000)->create();
    }
}
