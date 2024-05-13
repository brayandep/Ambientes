<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Docente']);
        $rol3 = Role::create(['name' => 'Jefe de carrera']);

        Permission::create(['name' => 'ambiente.ver'])->syncRoles([$rol1]);
        Permission::create(['name' => 'ambiente.registrar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'ambiente.editar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'materia.ver'])->syncRoles([$rol1]);
        Permission::create(['name' => 'materia.registrar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'materia.editar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'unidad.ver'])->syncRoles([$rol1]);
        Permission::create(['name' => 'unidad.registrar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'unidad.editar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'reserva.ver'])->syncRoles([$rol1]);
        Permission::create(['name' => 'reserva.confirmar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'publicacion.registrar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'publicacion.eliminar'])->syncRoles([$rol1]);
        // Permission::create(['name' => 'publicacion.editar']);

        Permission::create(['name' => 'evento.registrar'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'evento.editar'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'evento.eliminar'])->syncRoles([$rol1, $rol3]);

        Permission::create(['name' => 'usuario.registrar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'bitacora'])->syncRoles([$rol1]);

        Permission::create(['name' => 'backup'])->syncRoles([$rol1]);

    }
}
