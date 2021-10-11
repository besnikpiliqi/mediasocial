<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Comment;
use App\Models\LikeComment;

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
        // $comments =  Comment::factory(3)->make();
    //    ->each(function($comment){
            // Post::factory(rand(1,4))->create([
            //     "user_id"=> $user->id
            // ]);
            // LikeComment::create(["user_id"=>$comment->user_id,"post_id"=>$comment->post_id,"comment_id"=>$comment->comment_id,"stars"=>rand(1,5)]);
        // });
        for ($i=1; $i < 1000; $i++) { 
            $key = Comment::create([
                'user_id' => rand(1,30),
                'post_id' => rand(1,100),
                'content' => $faker->paragraph(),
            ]);
            // $comments =  DB::table('comments')->insertGetId(
            //     ['user_id' => 1, 'post_id' => 11,'content'=> $faker->paragraph()]
            // );
            // LikeComment::create(["user_id"=>$key->user_id,"post_id"=>$key->post_id,"comment_id"=>$key->id,"stars"=>rand(1,5)]);
        }
        // foreach ($comments as $key) {
        //     LikeComment::create(["user_id"=>$key->user_id,"post_id"=>$key->post_id,"comment_id"=>$key->comment_id,"stars"=>rand(1,5)]);
        // }
    }
}
