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
        $publicacion = \App\Models\Publication::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        
    }
}