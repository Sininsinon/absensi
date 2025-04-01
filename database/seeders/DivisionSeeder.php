<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        DB::table('divisions')->insert([
            ['name_divisions' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
