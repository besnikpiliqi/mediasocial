<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comment;
use App\Models\LikePost;
use App\Models\LikeComment;

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
