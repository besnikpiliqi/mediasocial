<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Comment;
use App\Models\LikePost;
use App\Models\LikeComment;
use App\Models\Photo;

use App\Casts\PostCasts;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id','photo','content'];
    
    protected $casts = [
        // 'id'=> PostCasts::class,
    ];
    
    // public function getUserIdAttribute($value)
    // {
    //     return Hash::make($value);
    // }
    // protected $guarded = [];
    
    // public function image()
    // {
    //     return $this->morphOne(Photo::class, 'imageable');
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','desc');
    }

    public function likes()
    {
        return $this->hasMany(LikePost::class);
    }
    public function likesComment()
    {
        return $this->hasManyThrough(LikeComment::class,Comment::class);// kjo eshte per dite sa lika i ka nje postim ne komentet e tij. kjo mirret me withCount ne Post
    }
}
