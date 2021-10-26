<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
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
        // LikePost::factory(1000)->create();
        $likes = [];
        for ($i=1; $i < 1000; $i++) {
            $post = Post::inRandomOrder()->first();
            
            $like_user_id = User::inRandomOrder()->first()->id;
            // LikePost::create([
            //     'user_id' => $like_user_id,
            //     'post_id' => $post->id,
            //     'stars' => rand(1,5),
            // ]);
            $likes[] = [
                'user_id' => $like_user_id,
                'post_id' => $post->id,
                'stars' => rand(1,5),
            ];
        }
        LikePost::insert($likes);
    }
}
