<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'player number one',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('user'),
                'phone' => '4715',
                'institution' => 'admin',
                'division_id' => 1,
                'category_id' => 1,
                'profile_picture' => 'default.png',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
