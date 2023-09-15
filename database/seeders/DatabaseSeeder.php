<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        \App\Models\Voters::factory(150)->create();
        \App\Models\Candidate::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email_verified_at' => now(),
            'email' => 'Admin@example.com',
            'password' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'DunhillLeal',
            'email_verified_at' => now(),
            'email' => 'dunhill@example.com',
            'password' => 'dunhill'
        ]);
    }
}
