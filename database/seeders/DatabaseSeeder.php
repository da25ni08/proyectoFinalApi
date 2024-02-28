<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pub_type;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        $userAdmin = new User();
        $userAdmin->name = 'Prueba Admin';
        $userAdmin->email = 'admin@gmail.com';
        $userAdmin->password = encrypt('1234');
        $userAdmin->phone = '1234';
        $userAdmin->save();


        $publicacion->commerces()->attach($user->id);


        //Seeder Usuarios y permisos 
        
        $rol_admin = Role::create(['name' => 'admin']);
        $rol_commerce = Role::create(['name' => 'commerce']);
        $rol_customer = Role::create(['name' => 'customer']);

        $perm_see_publication = Permission::create(['name' => 'see publication']);
        $perm_edit_publication = Permission::create(['name' => 'edit publication']);
        $perm_see_commerce = Permission::create(['name' => 'see commerce']);
        $perm_edit_commerce = Permission::create(['name' => 'edit commerce']);
        $perm_see_customer = Permission::create(['name' => 'see customer']);
        $perm_edit_customer = Permission::create(['name' => 'edit customer']);
        $perm_admin = Permission::create(['name' => 'admin']);

        $rol_customer->givePermissionTo($perm_see_publication);
        $rol_customer->givePermissionTo($perm_see_commerce);
        $rol_customer->givePermissionTo($perm_edit_customer);

        $rol_commerce->givePermissionTo($perm_see_commerce);
        $rol_commerce->givePermissionTo($perm_see_customer);
        $rol_commerce->givePermissionTo($perm_edit_commerce);
        $rol_commerce->givePermissionTo($perm_edit_publication);
        $rol_commerce->givePermissionTo($perm_see_publication);

        $rol_admin->givePermissionTo($perm_admin);
        $rol_admin->givePermissionTo($perm_see_commerce);
        $rol_admin->givePermissionTo($perm_edit_commerce);
        $rol_admin->givePermissionTo($perm_see_customer);
        $rol_admin->givePermissionTo($perm_edit_customer);
        $rol_admin->givePermissionTo($perm_see_publication);
        $rol_admin->givePermissionTo($perm_edit_publication);
    }
}
