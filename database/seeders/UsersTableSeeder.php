<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory(3)->create(["type" => "buyer"]);
        
        // Create admin user
      User::create([
    'name' => 'admin',
    'email' => 'admin@admin.com',
    'password' => Hash::make('admin'),
    'role'=> 'admin',   
]);

  
    }
}
