<?php

namespace App\Observers;

use App\Models\Follower;
use App\Models\Notification;

class FollowerObserver
{
    /**
     * Handle the Follower "created" event.
     *
     * @param  \App\Models\Follower  $follower
     * @return void
     */
    public function created(Follower $follower)
    {
        Notification::create(['user_id'=>$follower->follow_id,'action_user_id'=>$follower->user_id,'follow_id'=>$follower->user_id,'action'=>'followed']);
    }

    /**
     * Handle the Follower "updated" event.
     *
     * @param  \App\Models\Follower  $follower
     * @return void
     */
    public function updated(Follower $follower)
    {
        //
    }

    /**
     * Handle the Follower "deleted" event.
     *
     * @param  \App\Models\Follower  $follower
     * @return void
     */
    public function deleted(Follower $follower)
    {
        //
    }

    /**
     * Handle the Follower "restored" event.
     *
     * @param  \App\Models\Follower  $follower
     * @return void
     */
    public function restored(Follower $follower)
    {
        //
    }

    /**
     * Handle the Follower "force deleted" event.
     *
     * @param  \App\Models\Follower  $follower
     * @return void
     */
    public function forceDeleted(Follower $follower)
    {
        //
    }
}
