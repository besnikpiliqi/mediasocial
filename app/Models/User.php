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
