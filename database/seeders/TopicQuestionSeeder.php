<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class TopicQuestionSeeder extends Seeder
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
        $lstTopic = ['PHP','Python'];
        $lstImage = ['1670764589.png','1670764566.png'];

        for ($i = 0; $i < $limit; $i++){
            DB::table('topic_questions')->insert([
                'topic_question_name' => $lstTopic[$i],
                'description' => 'Các câu hỏi liên quan đến chu đề '.$lstTopic[$i],
                'image'=>$lstImage[$i],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
        }
    }
}