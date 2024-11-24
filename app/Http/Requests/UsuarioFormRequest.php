<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('usuario'), // Para evitar que el email se marque como único en la edición
            'password' => 'required|string|min:8|confirmed', // Obligatorio para la creación de usuarios
        ];
    
        if ($this->isMethod('put')) { // Si es una petición PUT (editar)
            // En la edición, la contraseña es opcional
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }
    
        return $rules;
    }
}
