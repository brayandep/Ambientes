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
        $usuario = new User();
        $usuario -> nombre = "Brayan";
        $usuario -> contraseña = "123";
     
        $usuario -> save();

        $usuario = new User();
        $usuario -> nombre = "Lucas";
        $usuario -> contraseña = "123";
     
        $usuario -> save();

        $usuario = new User();
        $usuario -> nombre = "Marcos";
        $usuario -> contraseña = "123";
     
        $usuario -> save();

    }
}
