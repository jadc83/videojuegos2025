<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideojuegoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'titulo' => 'required|string|max:255|unique:videojuegos,titulo',
                'salida' => 'required|date',
                'desarrolladora_id' => 'exists:desarrolladoras,id',
        ];
    }

    public function messages(): array
    {
        return [
                'titulo.required' => 'El titulo es obligatorio.',
                'titulo.max' => 'El titulo no puede tener más de 255 caracteres.',
                'titulo.unique' => 'El videojuego ya existe en la base de datos',
                'salida.required' => 'La fecha de salida es obligatorio.',
                'salida.date' => 'El salida debe ser una fecha válida.',

        ];
    }
}
