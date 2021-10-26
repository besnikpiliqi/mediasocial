<?php

namespace App\Observers;

use App\Models\LikeComment;
use App\Models\Post;
use App\Models\History;

class LikeCommentObserver
{
    /**
     * Handle the LikeComment "created" event.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return void
     */
    public function created(LikeComment $likeComment)
    {
        $post = Post::find($likeComment->post_id)->first();
        History::updateOrInsert(
            ['user_id'=>$post->user_id,'action_user_id'=>auth()->id(),'comment_id'=>$likeComment->comment_id,'action'=>'comment.voted'],
            ['stars'=>$likeComment->stars,'viewed'=>1]
        );
    }

    /**
     * Handle the LikeComment "updated" event.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return void
     */
    public function updated(LikeComment $likeComment)
    {
        $post = Post::find($likeComment->post_id)->first();
        History::updateOrCreate(
            ['user_id'=>$post->user_id,'action_user_id'=>auth()->id(),'comment_id'=>$likeComment->comment_id,'action'=>'comment.voted'],
            ['stars'=>$likeComment->stars,'viewed'=>1]
        );
    }

    /**
     * Handle the LikeComment "deleted" event.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return void
     */
    public function deleted(LikeComment $likeComment)
    {
        //
    }

    /**
     * Handle the LikeComment "restored" event.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return void
     */
    public function restored(LikeComment $likeComment)
    {
        //
    }

    /**
     * Handle the LikeComment "force deleted" event.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return void
     */
    public function forceDeleted(LikeComment $likeComment)
    {
        //
    }
}
