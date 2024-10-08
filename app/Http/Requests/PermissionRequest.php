<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required',
            'name' => 'required|unique:permissions,name'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Titulo é obrigatório!',
            'name.required' => 'Rota é obrigatório!',
            'name.unique' => 'Essa rota já existe! Defina uma diferente.'
        ];
    }
}
