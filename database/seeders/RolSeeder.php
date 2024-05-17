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
        $rol1 = Role::create(['name' => 'Admin', 'Estado' => 1, 'descripcionRol' => 'Controla todo', 'tipoVigencia' => 'permanente', 'fechaInicioRol' => '2024-05-13']);
        $rol2 = Role::create(['name' => 'Docente', 'Estado' => 1,  'descripcionRol' => 'Docente regular de la UMSS','tipoVigencia' => 'permanente', 'fechaInicioRol' => '2024-05-13']);
        $rol3 = Role::create(['name' => 'Jefe de carrera', 'Estado' => 1, 'descripcionRol' => 'Encargado de una carrera', 'tipoVigencia' => 'permanente', 'fechaInicioRol' => '2024-05-13']);

        Permission::create(['name' => 'Ver ambiente'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Regsitrar ambiente'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Editar ambiente'])->syncRoles([$rol1]);

        Permission::create(['name' => 'Ver materia'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Registrar materia'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Editar materia'])->syncRoles([$rol1]);

        Permission::create(['name' => 'Ver unidad'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Registrar unidad'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Editar unidad'])->syncRoles([$rol1]);

        Permission::create(['name' => 'Ver reserva'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Confirmar reserva'])->syncRoles([$rol1]);

        Permission::create(['name' => 'Registrar publicacion'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Eliminar publicacion'])->syncRoles([$rol1]);
        // Permission::create(['name' => 'publicacion.editar']);

        Permission::create(['name' => 'Registrar evento'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'Editar evento'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'Eliminar evento'])->syncRoles([$rol1, $rol3]);

        Permission::create(['name' => 'Registrar usuario'])->syncRoles([$rol1]);

        Permission::create(['name' => 'Control bitacora'])->syncRoles([$rol1]);

        Permission::create(['name' => 'Generar backup'])->syncRoles([$rol1]);
        
        Permission::create(['name' => 'Solicitar ambiente'])->syncRoles([$rol1, $rol2, $rol3]);
    }
}
