<?php

namespace Database\Factories;

use App\Models\LikePost;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikePostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikePost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,30),
            'post_id' => rand(1,100),
            'stars' => rand(1,5),
        ];
    }
}
