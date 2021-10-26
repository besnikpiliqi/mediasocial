<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Follower;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Follower::factory(30)->create();
        $u = 1;
        $r = 2;
        $arrUser = [];
        $arrFoll = [];
        for ($i=2; $i <= 300; $i++) { 
            // if($i == 30){
            //     $u = $u++;
            //     $i = $r++;
            //     if($u == 30) {
            //         exit;
            //     }
            // }
            // Follower::create([
            //     'user_id' => $u,
            //     'follow_id'=> $i
            // ]);
            $follow_ids = Follower::pluck('user_id');
            if($follow_ids){
                $user = User::inRandomOrder()->whereNotIn('id', $follow_ids)->first();
            }else{
                $user = User::inRandomOrder()->first();
            }
            
            if(!$user){
                continue;
            }
            $follow_id = User::inRandomOrder()->whereNotIn('id', [$user->id])->first()->id;
            // $followed_ids =  Follower::whereNotIn('user_id', User::where()->pluck('id'))->pluck('user_id');
            // $user_id = User::inRandomOrder()->whereNotIn('id', [$followed_ids])->first()->id;
            // $follow_id = User::inRandomOrder()->whereNotIn('id', [$user_id])->first()->id;
            if(!$user && !$follow_id){
                continue;
            }
            Follower::create([
                'user_id' => $user->id,
                'follow_id'=> $follow_id
            ]);
            
        }
    }
}
