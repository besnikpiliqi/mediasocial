<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class LikePost extends Model
{
    use HasFactory;

    protected $table = 'likes_post';

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
        'stars',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
