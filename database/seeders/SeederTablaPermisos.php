<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //tabla rol
            'ver-rol',
            'crear-rol',
            'editar-rol',
            

        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
