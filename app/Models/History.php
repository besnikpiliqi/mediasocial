<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class History extends Model
{
    use HasFactory;

    protected $table = 'historys';

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'action_user_id',
        'follow_id',
        'post_id',
        'comment_id',
        'action',
        'stars',
    ];
    
    // public function scopefirstOrUpdate($query,array $attributes, array $values = array()){
    //     $instance = $query->where($attributes)->first();
    //     if($instance){
    //         $instance->update($values)->save();
    //     }else{
    //         $query->create()
    //     }
    // }
    public function post()
    {
        return $this->belongsTo(Post::class)->select(['id','content']);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class)->select(['id','content']);
    }
    public function useraction()
    {
        return $this->belongsTo(User::class,'action_user_id')->select(['id','name','username','photo']);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->select(['id','name']);
    }
    
}
