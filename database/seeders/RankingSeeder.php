<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Faker\Factory;
use Carbon\Carbon;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Factory::create();
        $limit = 71;

        for ($i = 32; $i <= $limit; $i++){
            DB::table('ranking')->insert([
                'user_id' => $i,
                'score_single' => $fake->numerify($string = '###'),
                'score_challenge' => $fake->numerify($string = '###'),               
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
                'deleted_at'=>null,
                
            ]);
        }
    }
}