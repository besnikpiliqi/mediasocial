<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\City;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countrys';

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'country',
    ];

    public function citys()
    {
        return $this->hasMany(City::class);
    }
}
