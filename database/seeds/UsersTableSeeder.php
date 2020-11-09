<?php


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'レオ',
                'email' => 'reo@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'profile_img_path' => 'https://res.cloudinary.com/dojqb6g4z/image/upload/v1603206050/uzjez6xnseuk9qepmb2c.jpg',
            ],
            [
                'id' => 2,
                'name' => 'roi',
                'email' => 'roi@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'profile_img_path' => 'https://res.cloudinary.com/dojqb6g4z/image/upload/w_1000,ar_16:9,c_fill,g_auto,e_sharpen/v1601889743/samples/human/roi_v9lxqe.jpg',

            ],
            [
                'id' => 3,
                'name' => 'ルカ',
                'email' => 'ruka@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'profile_img_path' => 'https://res.cloudinary.com/dojqb6g4z/image/upload/v1602659149/g2qzkfhg5i5jdst0u3ju.jpg',
            ],
        ]);
    }
}
