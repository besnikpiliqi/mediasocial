<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class PostCasts implements CastsAttributes
{

    public function get($model, string $key, $value, array $attributtes)
    {
        return 'CT-'.$value.'-00';
    }

    public function set($model, string $key, $value, array $attributtes)
    {
        return Str::of($value)->before('CT-')->after('-00');
    }

}
