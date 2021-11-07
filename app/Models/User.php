<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\City;
use App\Models\Country;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Comment;
use App\Models\LikePost;
use App\Models\LikeComment;
use App\Models\Notification;
use App\Models\Photo;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'city_id',
        'photo',
        'password',
    ];
    // public function getIdAttribute($value)
    // {
    //     return Hash::make($value);
    // }
    // public function image()
    // {
    //     return $this->morphOne(Photo::class, 'imageable');
    // }
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }
    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }
    public function following()
    {
        return $this->hasMany(Follower::class);
    }

    public function followed()
    {
        return $this->hasMany(Follower::class,'follow_id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class)->orderBy('created_at', 'DESC');
    }
    public function haveLikedPost()
    {
        // this is for the user(selected) that have own likes posts that the other users have liked his posts
        return $this->hasManyThrough(LikePost::class, Post::class);
    }
    public function likesPost()
    {
        // this is for the posts liked that user(selected) has liked on the others users
       return $this->hasMany(LikePost::class);
    }
    public function likesComment()
    {
        // this is for the comments liked that user(selected) has liked on the others users
        // i put Comment::class because the comments.user_id need to check with the users.id because in the table comments contien the user _id of user that he have liked but not user_id of the post_id
        return $this->hasManyThrough(LikeComment::class, Comment::class);
    }
    public function haveLikedComment()
    {
        // this is for the user(selected) that have own likes comments that the other users have liked his comments
        // i put the Post::class because the post.user_id need to check with users.id because just in table posts are the user_id that contain to the user selected
        return $this->hasManyThrough(LikeComment::class, Post::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at','desc');
    }

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.preg_replace("/[^A-Za-z0-9 ]/", '', $value).'%');
    }
    public function scopeOrWhereLike($query, $column, $value)
    {   
        $value = preg_replace("/[^A-Za-z0-9 ]/", '', $value);
        return $query->orWhere($column, 'like', '%'.$value.'%');
        // $explodes = explode(" ", $value);
        // foreach($explodes as $explode){
        //     $request->orWhere($column, 'like', '%'.$explode.'%');
        // }
        // return $request;
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}
