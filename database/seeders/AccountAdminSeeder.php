<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class AccountAdminSeeder extends Seeder
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

        for ($i = 1; $i < $limit; $i++){
            DB::table('users')->insert([
                'display_name' => 'Trần Dương Chí Hiếu',
                'avatar' => 'no_avatar.png',
                'email' => 'tranduongchihieu@gmail.com',
                'phone_number' => '0934904497',
                'password'=>Hash::make('1'),
                'address'=> 'Thành phố Hồ Chí Minh',
                'dateOfBirth' => Carbon::now('Asia/Ho_Chi_Minh'),
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'isAdmin'=>1,
                'isSubAdmin'=>0,
                'life_heart'=>0,
                'token'=>null,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
                'status' => 1,
            ]);
        }
    }
}