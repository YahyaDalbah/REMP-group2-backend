<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Transaction;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = Property::all();
        $users = User::all();
    
        foreach ($properties as $property) {
            Transaction::factory(3)->create([
                'property_id' => $property->id,
                'buyer_id' => $users->random()->id,
            ]);
        }
    }
}
