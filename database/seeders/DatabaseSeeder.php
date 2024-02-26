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
        $pub_type = \App\Models\Pub_type::factory()->create([
            'name' => 'Prueba Tipo',
        ]);

        $publicacion = \App\Models\Publication::factory()->create([
            'title' => 'Prueba Publicacion',
            'description' => 'Prueba',
            'pub_type_id' => '1',
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Prueba User',
            'email' => 'prueba@gmail.com',
            'password' => encrypt('1234'),
            'phone' => '1234',
        ]);

        $publicacion->users()->attach($user->id);
    }
}
