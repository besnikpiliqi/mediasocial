<?php

namespace Database\Factories;

use App\Models\LikeComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikeComment::class;

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
            'comment_id' => rand(1,1000),
            'stars' => rand(1,5),
        ];
    }
}
