<?php

namespace Database\Factories;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class MateriaFactory extends Factory
{
    protected $model = Materia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $opciones_nombres = [
            "LICENCIATURA DIDACTICA MATEMATICA",
            "LICENCIATURA EN BIOLOGIA",
            "LICENCIATURA EN DIDACTICA DE LA FISICA",
            "LICENCIATURA EN FISICA",
            "LICENCIATURA EN ING. ELECTROMECANICA",
            "LICENCIATURA EN INGENIERIA CIVIL (NUEVO)",
            "LICENCIATURA EN INGENIERIA DE ALIMENTOS",
            "LICENCIATURA EN INGENIERIA DE SISTEMAS",
            "LICENCIATURA EN INGENIERIA ELECTRICA",
            "LICENCIATURA EN INGENIERIA ELECTRONICA",
            "LICENCIATURA EN INGENIERIA INDUSTRIAL",
            "LICENCIATURA EN INGENIERIA INFORMATICA",
            "LICENCIATURA EN INGENIERIA MATEMATICA",
            "LICENCIATURA EN INGENIERIA MECANICA",
            "LICENCIATURA EN INGENIERIA QUIMICA",
            "LICENCIATURA EN MATEMATICAS",
            "LICENCIATURA EN QUIMICA",
            "PROGRAMA DE INGENIERIA EN BIOTECNOLOGIA",
            "PROGRAMA LIC. EN INGENIERIA EN ENERGIA"
        ];

        $materiaSistemas = [
            "Ingles",
            "Fisica General",
            "Algebra I",
            "Calculo I",
            "Introduccion a la Programacion",
            "Metodologia Investigacion y Tec Comunicacion",
            "Algebra II",
            "Calculo II",
            "Matematica Discreta",
            "Elem. de Programacion y Estruc. de Datos",
            "Arquitectura de Computadoras I",
            "Ecuaciones Diferenciales",
            "Estadistica I",
            "Calculo Numerico",
            "Metodos Tecnicas y Taller de Programacion",
            "Base de Datos I",
            "Circuitos Electronicos",
            "Estadistica II",
            "Base de Datos II",
            "Taller de Sistemas Operativos",
            "Sistemas de Informacion I",
            "Contabilidad Basica",
            "Investigacion Operativa I",
            "Ingles II",
            "Sistemas de Informacion II",
            "Aplicacion de Sistemas Operativos",
            "Taller de Base de Datos",
            "Sistemas I",
            "Investigacion Operativa II",
            "Mercadotecnia",
            "Simulacion de Sistemas",
            "Ingenieria de Software",
            "Inteligencia Artificial",
            "Redes de Computadoras",
            "Sistemas II",
            "Sistemas Economicos",
            "Redes de Nueva Generacion",
            "Taller de Ingenieria de Software",
            "Gestion de Calidad de Software",
            "Redes Avanzadas de Computadoras",
            "Dinamica de Sistemas",
            "Aplic. Interactivas para Television Digital",
            "Cloud Computing",
            "Electrotecnia Industrial",
            "Planificacion y Evaluacion de Proyectos",
            "Ingles III",
            "Evaluacion y Auditoria de Sistemas",
            "Taller de Simulacion de Sistemas",
            "Metodol. y Planif. de Proyecto de Grado",
            "Seguridad de Sistemas",
            "Informatica Forense",
            "Gestion Estrategica de Empresas",
            "Proyecto Final",
            "Taller de Titulacion",
            "Practica Empresarial",
            "Entornos Virtuales de Aprendizaje",
            "Servicios Telematicos",
            "Reconocimiento de Voz",
            "Business Intelligence y Big Data",
            "Ciencia de Datos y Machine Learning",
            "Planif. y Control de la Produccion I",
            "Ingenieria Economica",
            "Planif. y Control de la Produccion II",
            "Costos Industriales",
            "Ingenieria de Metodos y Reingenieria",
            "Diseno de Compiladores"
        ];
        

        return [
            'departamento'=> $this->faker->randomElement(['Depto de Sistemas','Depto de Industrial','Depto de Informatica','Depto de Matematica']), 
            'carrera'=> $this->faker->randomElement($opciones_nombres), 
            'nombre'=> $this->faker->unique()->randomElement($materiaSistemas), 
            'codigo' => str_pad($this->faker->numberBetween(0, 999999), 6, '0'), 
            'nivel'=> $this->faker->randomElement(['A','B','C','D','E','F','G','H','I','J']), 
            'cantGrupo' => $this->faker->randomElement([1,2,3,4,5])
        ];
    }
}
