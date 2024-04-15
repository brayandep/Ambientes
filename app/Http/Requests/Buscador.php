<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscadorR extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        return [
            'nombre' => 'regex:/^[a-zA-Z\s]/',
            'capacidad' => 'numeric',
            'horaIni' => [
                'date_format:H:i', // Formato de hora (HH:MM)
                'after:06:45',     // Hora de inicio debe ser después de las 6:45 am
                'before:20:15',    // Hora de inicio debe ser antes de las 8:15 pm
            ],
            'horaFin' => [
                'date_format:H:i', // Formato de hora (HH:MM)
                'after:08:15',     // Hora de fin debe ser después de las 8:15 am
                'before:21:45',    // Hora de fin debe ser antes de las 9:45 pm
            ],
        ];
    }

    public function messages():array
    {
    return [
        'horaInio.date_format' => 'El campo Hora de inicio debe tener el formato HH:MM.',
        'horaIni.after' => 'La Hora de inicio debe ser después de las 6:45 am.',
        'horaIni.before' => 'La Hora de inicio debe ser antes de las 8:15 pm.',
        'horaFin.date_format' => 'El campo Hora de fin debe tener el formato HH:MM.',
        'horaFin.after' => 'La Hora de fin debe ser después de las 8:15 am.',
        'horaFin.before' => 'La Hora de fin debe ser antes de las 9:45 pm.',
    ];
    }
}