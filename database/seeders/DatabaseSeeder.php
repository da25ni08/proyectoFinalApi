<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pub_type;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pub_type = new Pub_type();
        $pub_type->name = "prueba";
        $pub_type->save();

        $publicacion = new Publication();
        $publicacion->title = 'Prueba Publicacion';
        $publicacion->description = 'Prueba';
        $publicacion->pub_type_id = '1';
        $publicacion->save();

        $user = new User();
        $user->name = 'Prueba User';
        $user->email = 'prueba@gmail.com';
        $user->password = encrypt('1234');
        $user->phone = '1234';
        $user->save();


        $publicacion->commerces()->attach($user->id);
    }
}
