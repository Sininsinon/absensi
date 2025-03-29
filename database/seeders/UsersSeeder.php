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
                'name' => 'tesss',
                'email' => 'tessss',
                'password' => Hash::make('user'),
                'phone' => '081234567890',
                'institution' => 'Universitas Semarang',
                'division_id' => 1,
                'profile_picture' => 'default.png',
                'role' => 'intern',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
