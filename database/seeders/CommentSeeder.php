<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $comments = [];
        for ($i=1; $i < 1000; $i++) {
            $user_id = User::inRandomOrder()->first()->id;
            $post = Post::inRandomOrder()->where('user_id', $user_id)->first();
            if($post == null){
                continue;
            }
            $comment_user_id = User::inRandomOrder()->whereNotIn('id', [$user_id])->first()->id;
            // Comment::create([
            //     'user_id' => $comment_user_id,
            //     'post_id' => $post->id,
            //     'content' => $faker->paragraph(),
            // ]);
            $comments[] = [
                'user_id' => $comment_user_id,
                'post_id' => $post->id,
                'content' => $faker->paragraph(),
            ];
        }
        Comment::insert($comments);
    }
}
