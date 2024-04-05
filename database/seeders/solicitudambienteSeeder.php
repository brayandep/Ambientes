<?php

namespace Database\Seeders;
use App\Models\Models\Usuario;
use App\Models\Models\Solicitud;
use Illuminate\Database\Seeder;

class solicitudambienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $usuario = new Usuario();
        $usuario -> nombre = "brayan";
        $usuario -> contraseña = "11111111";
      
        $usuario -> save();

    }
}
