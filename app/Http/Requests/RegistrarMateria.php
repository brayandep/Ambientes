<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarMateria extends FormRequest
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
            'departamento' => 'required',
            'carrera' => 'required',
            'nombre' => 'required|unique:materia,nombre|max:100|regex:/^[a-zA-Z\s]+$/',
            'codigo' => 'required|numeric|digits:6|unique:materia,codigo',
            'nivel' => 'required',
            'cantGrupo' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'cantGrupo.required' => 'El grupo es requerido'
        ];
    }
}
