<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class QuestionSeeder extends Seeder
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
        $lstTopic = ['1','2'];
        $lstLevel = ['1','2'];
        $lstContentPHP = ['Trình dịch PHP nào bạn cho là đúng?',
        'Engine nào là nền tảng chính của PHP?',
        'Cài đặt Apache xong bạn có thể xem servername của bạn bằng cách  gọi url http://localhost, ngoài ra còn có thể sử dụng cách nào nữa không?',
        'Khi sử dụng bộ PHP và Apache bạn phải trả?',
        'Ai là người đầu tiên phát minh ra PHP','PHP dựa teo syntax của ngôn nữa nào?',
        'W tượng trưng cho chữ nào trong gói WAMP?',
        'Trước khi đổi thành PHP: HyperText Preprocessor nguồn gốc của nó xuất phát từ cụm từ nào?',
        'Khi thực thi biến này "$var3 =  $var1 % $var2;" dạng type của nó là?',
        'Dạng type nào sẽ được tự động dịch khi bán giá trị cho biến này? "$var = 50.0;"',
        'Số 41 tương đương với số bit nào?'];


        for ($i = 0; $i < $limit; $i++){
            if($i <= 10){
                DB::table('questions')->insert([
                'question_content' => $lstContentPHP[$i],
                'topic_id' =>$lstTopic[0],
                'level_id' =>$i <= 5 ? $lstLevel[0] : $lstLevel[1],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
                
            ]);
            for($j = 0; $j < 4;$j++){
                DB::table('answer_questions')->insert([
                    'question_id' => $i+1,
                    'answer_content' =>'Câu trả lời '.$j+ 1,
                    'isTrue'=> $j == 1 ? 1 : 0,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => null,
                ]);
            }
            }else{
                DB::table('questions')->insert([
                'question_content' => $lstContentPHP[$i],
                'topic_id' =>$lstTopic[1],
                'level_id' =>$lstLevel[0],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            for($j = 0; $j <4;$j++){
                DB::table('answer_questions')->insert([
                    'question_id' => $i+1,
                    'answer_content' =>'Câu trả lời '.$i+ 1,
                    'isTrue'=> $j == 1 ? 1 : 0,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => null,
                ]);
            }
            }
        }
    }
}