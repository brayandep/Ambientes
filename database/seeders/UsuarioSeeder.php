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
        $usuario1 -> email = "michelle123@gmail.com";
        $usuario1 -> save();

        $usuario2 = new User();
        $usuario2 -> nombre = "Melvi";
        $usuario2 -> password = Hash::make("12345678");
        $usuario2 -> email = "melvi123@gmail.com";
        $usuario2 -> save();

        $usuario3 = new User();
        $usuario3 -> nombre = "Brayan";
        $usuario3 -> password = Hash::make("12345678");
        $usuario3 -> email = "brayan123@gmail.com";
        $usuario3 -> save();

        $usuario4 = new User();
        $usuario4 -> nombre = "Camila";
        $usuario4 -> password = Hash::make("12345678");
        $usuario4 -> email = "camila123@gmail.com";
        $usuario4 -> save();

        $usuario5 = new User();
        $usuario5 -> nombre = "Katherine";
        $usuario5 -> password = Hash::make("12345678");
        $usuario5 -> email = "katherine123@gmail.com";
        $usuario5 -> save();

        $usuario6 = new User();
        $usuario6 -> nombre = "Jhosemar";
        $usuario6 -> password = Hash::make("12345678");
        $usuario6 -> email = "jhosemar123@gmail.com";
        $usuario6 -> save();

        $usuario6 = new User();
        $usuario6 -> nombre = "SamrtByte";
        $usuario6 -> password = Hash::make("byte123**");
        $usuario6 -> email = "smartbyte626@gmail.com";
        $usuario6 -> assignRole('Admin', 'Docente');
        $usuario6 -> save();
    }
}
