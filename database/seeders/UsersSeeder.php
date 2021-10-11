<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->hasPosts(3)->create();
        User::factory(30)->create();
        // $users = User::factory()->count(3)->create()
        // ->each(function($user){
        //     Post::factory(rand(1,4))->create([
        //         "user_id"=> $user->id
        //     ]);
        // });


        // $userId = User::insertGetId([
        //     'name' => $request->input('name'),
        //      'email' => $request->input('email'),
        //      'password' => bcrypt($request->input('password')),
        // ]);
        

        // User::factory()->has(Post::factory())->count(3)->create();
        // Post::factory()->for(User::factory())->count(3)->create();
        // Post::factory()->count(3)->create();// edhe kjo i krijon userin
        // User::factory()
        //     ->has(
        //         Post::factory()
        //                 ->count(3)
        //                 ->state(function (array $attributes, User $user) {
        //                     return ['user_id' => $user->id];
        //                 })
        //     )
        //     ->create();
        // User::factory()
        //     ->has(Post::factory()->count(3), 'posts')
        //     ->create();


    }
}
