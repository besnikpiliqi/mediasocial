<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\LikePost;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'followers';

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'follow_id',
    ];
    

    public function userFollowing()
    {
        return $this->belongsTo(User::class,'follow_id');
    }

    public function userFollowed()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'user_id','follow_id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class,/*inner on posts.*/'user_id',/*comments.*/'post_id',/* model=followers*/'follow_id','id')->orderBy('created_at', 'DESC');
        //  me kthy ne sql me pa request   ->toSql()
    }

    public function likes()
    {
        return $this->hasMany(LikePost::class);
    }
}
