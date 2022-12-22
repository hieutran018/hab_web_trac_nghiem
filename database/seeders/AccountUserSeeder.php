<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class AccountUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Factory::create();
        $limit = 10;
        $limit_rank = 12;
        $avatar = ['1670762878.jpg','1670775191.jpg','1670775201.jpg','1670763064.jpg',
        '1670763184.png','no_avatar.png','no_avatar.png','no_avatar.png','no_avatar.png','no_avatar.png'];

        for ($i = 0; $i < $limit; $i++){
            DB::table('users')->insert([
                'display_name' => $fake->name,
                'avatar' => $avatar[$i],
                'email' => $fake->unique->email,
                'phone_number' => $fake->phoneNumber,
                'password'=>Hash::make('1'),
                'address'=> 'Thành phố Hồ Chí Minh',
                'dateOfBirth' => Carbon::now('Asia/Ho_Chi_Minh'),
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'isAdmin'=>0,
                'isSubAdmin'=>0,
                'life_heart'=>3,
                'token'=>null,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'status' => 1,
            ]);
        }
        
        for ($i = 2; $i < $limit_rank; $i++){
            DB::table('ranking')->insert([
                'user_id'=>$i,
                'score_single'=>0,
                'score_challenge'=>0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
                'deleted_at' => null,
            ]);
        }
    }
}