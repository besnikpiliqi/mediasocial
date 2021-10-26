<?php

namespace Database\Seeders;

use Database\Seeders\UsersSeeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\Follower;
use App\Models\User;
use App\Models\Comment;
use App\Models\LikePost;
use App\Models\LikeComment;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $users = User::factory(10)->create();
        // $this->call(CountrySeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(UsersSeeder::class);
        // $this->call(FollowerSeeder::class);
        // $this->call(PostSeeder::class);
        // $this->call(LikePostSeeder::class);
        // $this->call(CommentSeeder::class);
        // $this->call(LikeCommentSeeder::class);


        for ($i=0; $i < 50; $i++) { 
            $userId = User::insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'username'=> $faker->username(),
                'photo'=> '/storage/profile//AAAKDLCIL71wfwPEV5yKJpPhe6GKWj3A6YJascgP.jpg',
                'password' => Hash::make($request->input('password')),
            ]);
            $userId = User::insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'username'=> $faker->username(),
                'photo'=> '/storage/profile//AAAKDLCIL71wfwPEV5yKJpPhe6GKWj3A6YJascgP.jpg',
                'password' => Hash::make($request->input('password')),
            ]);
        }

        // $user = User::factory()->create();
        // $posts = Post::factory(40)->create(['user_id' => $user->id]);

        // for ($i=0; $i<=2; $i++) {
        //     $user = User::factory(1)->create()->first();
        //     $product = Post::factory(1)->create(['user_id' => $user->id])->first();
        // }
        // $link_ids = User::all()->pluck('id')->first();
        // $product = Post::factory(1)->create(['user_id' => $link_ids->id]);
        // $faker = Faker::create();
        // User::factory(1)->create()->each(function ($user) use ($faker) {
        //     // Seed the relation with one address
        //     $post = [
        //     // 'user_id'=>$user->id,
        //         'photo'=>'http://lorempixel.com/400/200/sports/',
        //         'content' => $faker->paragraph(),
        //     ];
        //     $user->posts()->saveMany($post);

        //     // Seed the relation with 5 purchases
        //     // $purchases = factory(App\CustomerPurchase::class, 5)->make();
        //     // $customer->purchases()->saveMany($purchases);
        // });

        // User::factory(50)->create() 
        //         ->each( 
        //             function ($u) {
        //                 Post::factory(10)->create()
        //                         ->each(
        //                             function($p) use (&$u) { 
        //                                 $u->posts()->save($p)->make();
        //                             }
        //                         );
        //             }
        //         );
        
        // for ($i=0; $i < 3; $i++) { 
        //     $faker = Faker::create();
        //     $users = User::create([
        //         'name' => $faker->name(),
        //         'username' => $faker->username(),
        //         'photo' => "http://lorempixel.com/400/200/sports/",
        //         'email' => $faker->unique()->safeEmail(),
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'remember_token' => Str::random(10),
        //     ]);
        //     $users->each(function($user){
                
        //     })
        // }
        // for ($y=0; $y < 5; $y++) { 
        //     $user_id = rand(1,3);
            
        //         $faker = Faker::create();
        //         $post = new Post();
        //         $post->user_id = $user_id;
        //         $post->content = $faker->paragraph();
        //         $post->photo = "http://lorempixel.com/400/200/sports/";
        //         $post->save();
                
                
        //         $post->each(function ($postId) use ($user_id){
        //             $check = LikePost::where(["user_id"=>$user_id,"post_id"=>$postId->id])->first();
        //             if (!$check) {
        //                 $likedposte = false;
        //                 $likeP = new LikePost();
        //                 $likeP->user_id = $user_id;
        //                 $likeP->stars = rand(1,5);
        //                 $likeP->post_id = $postId->id;
        //                 $likeP->save();
        //             }

        //             for ($n=0; $n < rand(1,3); $n++) { 
        //                 $faker = Faker::create();
        //                 $comment = new Comment();
        //                 $comment->user_id = $user_id;
        //                 $comment->post_id = $postId->id;
        //                 $comment->content = $faker->paragraph();
        //                 $comment->save();
                        
        //                 $comment->each(function ($commentId) use ($user_id){
        //                     $check = LikeComment::where(["user_id"=>$user_id,"comment_id"=>$commentId->id])->first();
        //                     if (!$check) { 
        //                         $likeC = new LikeComment();
        //                         $likeC->user_id = $user_id;
        //                         $likeC->stars = rand(1,5);
        //                         $likeC->comment_id = $commentId->id;
        //                         $likeC->save();
        //                     }
        //                 });
        //             }
                    
        //         });
            
        // }
        
        
        
        
        
    
        // $user = User::create([
        //     'name' => $faker->name(),
        //     'email' => $faker->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);
        // $user = new User();
        // $user->name = $faker->name();
        // $user->email = $faker->unique()->safeEmail();
        // $user->email_verified_at = now();
        // $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        // $user->remember_token = Str::random(10);
        // $user->save();

        // $post = new Post();
        // $post->user_id = 1;
        // $post->content = "sdsd - ".$user->id." - ds";
        // $post->save();
        // Post::create([
        //     "user_id"=>$user->id,
        //     "content"=> $faker->paragraph()
        // ]);
    }
}
