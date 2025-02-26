<?php

namespace App\Http\Requests;

use App\Models\Posesion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateVideojuegoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        if (!Auth::check()) {
            abort(403, 'No hay ningún usuario logueado');
        }

        $videojuego_id = $this->route('videojuego')->id;

        if (!Posesion::where('user_id', Auth::id())->where('videojuego_id', $videojuego_id)->exists()) {
            abort(403, 'No posees este videojuego');
        }

        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'titulo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('videojuegos')->ignore($this->route('videojuego'))],
            'salida' => 'required|date',
            'desarrolladora_id' => 'required|exists:desarrolladoras,id',
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
