<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Country;

class City extends Model
{
    use HasFactory;


    protected $table = 'citys';

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'city',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
