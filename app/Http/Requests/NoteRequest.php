<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:300',
            'creation_date' => 'required|date',
            'expiration_date' => 'nullable',
            'image_uri' => 'nullable|string',
            'user_id' => 'required|numeric|min:1',
            'tag_id' => 'required|numeric|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser una cadena de texto.',
            'title.max' => 'El título no debe exceder los 100 caracteres.',

            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder los 300 caracteres.',

            'creation_date.required' => 'La fecha de creación es obligatoria.',
            'creation_date.date' => 'La fecha de creación debe ser una fecha válida.',

            'expiration_date.nullable' => 'La fecha de expiración es opcional.',

            'image_uri.nullable' => 'La URL de la imagen es opcional.',
            'image_uri.string' => 'La URL de la imagen debe ser una cadena de texto válida.',

            'user_id.required' => 'El identificador del usuario es obligatorio.',
            'user_id.numeric' => 'El identificador del usuario debe ser numérico.',
            'user_id.min' => 'El identificador del usuario debe ser mayor o igual a 1.',

            'tag_id.required' => 'El identificador de la etiqueta es obligatorio.',
            'tag_id.numeric' => 'El identificador de la etiqueta debe ser numérico.',
            'tag_id.min' => 'El identificador de la etiqueta debe ser mayor o igual a 1.',
        ];
    }
}
