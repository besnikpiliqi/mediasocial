<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Comment;
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
        // LikeComment::factory(1000)->create();
        LikeComment::truncate();
        $users = [];
        for ($i=0; $i < 1000; $i++) {
            $comment = Comment::inRandomOrder()->first();
            
            $like_user_id = User::inRandomOrder()->first()->id;
            // 3.45 seconda for insert 1000 row
            // LikeComment::create([
            //     'user_id' => $like_user_id,
            //     'post_id' => $comment->post_id,
            //     'comment_id' => $comment->id,
            //     'stars' => rand(1,5),
            // ]);
            $users[] = [
                'user_id' => $like_user_id,
                'post_id' => $comment->post_id,
                'comment_id' => $comment->id,
                'stars' => rand(1,5),
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }
        // 65 second for insert 1000 row
        LikeComment::insert($users);
    }
}
