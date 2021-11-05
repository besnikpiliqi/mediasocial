<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification as NotificationUser;

class Notification extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = User::inRandomOrder()->get('id')->except(auth()->id());
        $notifications = [];
        $arr = array( 'followed', 'commented', 'post.voted', 'comment.voted' );
        for ($i=0; $i < 100; $i++) { 
            
            $action = array_rand($arr,2);
            $user_id = User::inRandomOrder()->first()->id;
            $action_user_id = User::inRandomOrder()->whereNotIn('id', [$user_id])->first()->id;
            $post = Post::inRandomOrder()->where('user_id', $user_id)->first();
            $comment = $post != null ? Comment::inRandomOrder()->where('user_id', $post->id)->first() : null;
            $comment_id = $comment != null ? $comment->id : null;
            if($post == null || $comment == null){
                continue;
            }
            $arrFill = ['user_id'=> $user_id, 'action_user_id'=>$action_user_id,'action'=>$arr[$action[0]]];
            
            if($arr[$action[0]] == "followed"){
                $arrFill['follow_id'] = $action_user_id;
            }elseif($arr[$action[0]] == "post.voted"){
                $arrFill['post_id'] = $post != null ? $post->id : null;
            }elseif($arr[$action[0]] == "comment.voted" || $arr[$action[0]] == "commented"){
                $arrFill['comment_id'] = $comment_id;
            }elseif(in_array($action,['comment.voted','post.voted'])){
                $arrFill['stars'] = rand(1,5);
            }
            // $notifications[] = $arrFill;
            NotificationUser::create($arrFill);
        }
        // NotificationUser::insert($notifications); // kishte nje problem me relation post_id;

    }
}