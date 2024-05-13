<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $usuario1 = new User();
        $usuario1 -> nombre = "Brayan";
        $usuario1 -> contraseña = "123";
     
        $usuario1 -> save();

        $usuario2 = new User();
        $usuario2 -> nombre = "Lucas";
        $usuario2 -> contraseña = "123";
        $usuario2 -> save();

        $usuario3 = new User();
        $usuario3 -> nombre = "Marcos";
        $usuario3 -> contraseña = "123";
        $usuario3 -> save();

    }
}
