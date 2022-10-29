<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class Users_adminSeeder extends Seeder
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

        for ($i = 0; $i < $limit; $i++){
            DB::table('users')->insert([
                'first_name' => $fake->name,
                'last_name' => $fake->name,
                'avatar' => null,
                'email' => $fake->unique->email,
                'phone_number' => $fake->phoneNumber,
                'password'=>Hash::make('1'),
                'address'=> 'Thành phố Hồ Chí Minh',
                'dateOfBirth' => Carbon::now('Asia/Ho_Chi_Minh'),
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'isAdmin'=>1,
                'isSubAdmin'=>0,
                'life_heart'=>0,
                'token'=>null,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'status' => 1,
            ]);
        }
    }
}