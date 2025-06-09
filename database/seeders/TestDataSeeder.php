<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('properties')->insert([
            'user_id' => 1,
            'owner_id' => 1,
            'views' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('inquiries')->insert([
            'property_id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'Hello, this is a test inquiry.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('sales')->insert([
            'property_id' => 1,
            'price' => 100000,
            'sold_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
