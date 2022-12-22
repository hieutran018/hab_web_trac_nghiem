<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class LevelQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Factory::create();
        $limit = 2;
        $lstLevel = ['Dễ','Trung Bình','Khó'];

        for ($i = 0; $i < $limit; $i++){
            DB::table('levels')->insert([
                'level_name' => $lstLevel[$i],
                'description' => 'Các câu hỏi có độ khó '.$lstLevel[$i],
                'amount_question'=>($i == 0 ? 10 : $i) == 1? 15 : 20,
                'time_answer'=>($i == 0 ? 15 : $i) == 1? 15 : 10,
                'point'=>($i == 0 ? 20 : $i) == 1? 25 : 30,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
        }
    }
}