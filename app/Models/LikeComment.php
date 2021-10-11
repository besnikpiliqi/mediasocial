<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class LikeComment extends Model
{
    use HasFactory;

    protected $table = 'likes_comment';

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'stars',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
