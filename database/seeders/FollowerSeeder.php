<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        
        for ($i=2; $i <= 30; $i++) { 
            if($i == 30){
                $u = $u++;
                $i = $r++;
                if($u == 30) {
                    exit;
                }
            }
            Follower::create([
                'user_id' => $u,
                'follow_id'=> $i
            ]);
            
        }
    }
}
