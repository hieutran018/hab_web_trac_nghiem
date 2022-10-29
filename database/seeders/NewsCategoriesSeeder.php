<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class NewsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Factory::create();
        $limit = 5;
        $listCate = ['Xã Hội','Văn Hóa','Chính Trị','Khoa Học','Ẩm Thực','Y Tế','Giáo Dục'];

        for ($i = 0; $i < $limit; $i++){
            DB::table('news_categories')->insert([
                'news_category_name' => $listCate[$i],
                'description' => 'Tin tức liên quan đến '.$listCate[$i],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
                'status' => 1,
            ]);
        }
    }
}