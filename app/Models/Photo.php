<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['imageable_id','imageable_type','photo'];

    protected $guarded = [];

    public function imageable()
    {
        // https://www.youtube.com/watch?v=C7T1689IvPQ
        return $this->morphTo();
    }
}
