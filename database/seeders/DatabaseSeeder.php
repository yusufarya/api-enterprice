<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User_role;
use App\Models\Period;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User_role::create([
            'id' => 1,
            'name' => 'Super Admin',
        ]);
        User_role::create([
            'id' => 2,
            'name' => 'Admin',
        ]);
        
        Period::create([
            'id_period' => 1,
            'year' => date('Y'),
            'month' => date('m'),
        ]);
    }
}
