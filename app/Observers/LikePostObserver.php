<?php

namespace App\Observers;

use App\Models\LikePost;
use App\Models\Post;
use App\Models\Notification;

class LikePostObserver
{
    /**
     * Handle the LikePost "created" event.
     *
     * @param  \App\Models\LikePost  $likePost
     * @return void
     */
    public function created(LikePost $likePost)
    {
        $post = Post::find($likePost->post_id)->first();
        Notification::create(
            ['user_id'=>$post->user_id,
            'action_user_id'=>auth()->id(),
            'post_id'=>$likePost->post_id,
            'action'=>'post.voted',
            'stars'=>$likePost->stars]
        );
    }

    /**
     * Handle the LikePost "updated" event.
     *
     * @param  \App\Models\LikePost  $likePost
     * @return void
     */
    public function updated(LikePost $likePost)
    {
        $post = Post::find($likePost->post_id)->first();
        Notification::where(['user_id'=>$post->user_id,'action_user_id'=>auth()->id(),'post_id'=>$likePost->post_id,'action'=>'post.voted'])
        ->update(['stars'=>$likePost->stars,'viewed'=>1]);
    }

    /**
     * Handle the LikePost "deleted" event.
     *
     * @param  \App\Models\LikePost  $likePost
     * @return void
     */
    public function deleted(LikePost $likePost)
    {
        //
    }

    /**
     * Handle the LikePost "restored" event.
     *
     * @param  \App\Models\LikePost  $likePost
     * @return void
     */
    public function restored(LikePost $likePost)
    {
        //
    }

    /**
     * Handle the LikePost "force deleted" event.
     *
     * @param  \App\Models\LikePost  $likePost
     * @return void
     */
    public function forceDeleted(LikePost $likePost)
    {
        //
    }
}
