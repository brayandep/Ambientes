<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario1 = new User();
        $usuario1 -> nombre = "Michelle";
        $usuario1 -> password = Hash::make("12345678");
        $usuario1 -> email = "mjfigueropez@gmail.com";
        $usuario1 -> rol = 'Jefe de carrera';
        $usuario1 -> assignRole('Jefe de carrera');
        $usuario1 -> save();

        $usuario2 = new User();
        $usuario2 -> nombre = "Melvi";
        $usuario2 -> password = Hash::make("12345678");
        $usuario2 -> email = "melvi.rocio28@gmail.com";
        $usuario2 -> rol = 'Docente';
        $usuario2 -> assignRole('Docente');
        $usuario2 -> save();

        $usuario3 = new User();
        $usuario3 -> nombre = "Brayan";
        $usuario3 -> password = Hash::make("12345678");
        $usuario3 -> email = "brayanjulioquispe@gmail.com";
        $usuario3 -> rol = 'Docente';
        $usuario3 -> assignRole('Docente');
        $usuario3 -> save();

        $usuario4 = new User();
        $usuario4 -> nombre = "Camila";
        $usuario4 -> password = Hash::make("12345678");
        $usuario4 -> email = "camymontan@gmail.com";
        $usuario4 -> rol = 'Encargado de ambientes';
        $usuario4 -> assignRole('Encargado de ambientes');
        $usuario4 -> save();

        $usuario5 = new User();
        $usuario5 -> nombre = "Katherine";
        $usuario5 -> password = Hash::make("12345678");
        $usuario5 -> email = "katherineortiz440@gmail.com";
        $usuario5 -> rol = 'Jefe de carrera';
        $usuario5 -> assignRole('Jefe de carrera');
        $usuario5 -> save();

        $usuario6 = new User();
        $usuario6 -> nombre = "Jhosemar";
        $usuario6 -> password = Hash::make("12345678");
        $usuario6 -> email = "jhoten703@gmail.com";
        $usuario6 -> rol = 'Docente';
        $usuario6 -> assignRole('Docente');
        $usuario6 -> save();

        $usuario7 = new User();
        $usuario7 -> nombre = "SmartByte";
        $usuario7 -> password = Hash::make("byte123**");
        $usuario7 -> email = "smartbyte626@gmail.com";
        $usuario7 -> rol = 'Admin';
        $usuario7 -> assignRole('Admin');
        $usuario7 -> save();
    }
}
