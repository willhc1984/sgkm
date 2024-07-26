<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'nome' => 'required',
            'preco_fornecedor' => 'required',
            'preco_loja' => 'required',
            'comissao_consultor' => 'required',
        ];
    }

    public function messages(): array{
        return [
            'nome.required' => 'Nome do produto é obrigatório!',
            'preco_fornecedor.required' => 'Preço do fornecedor é obrigatório!',
            'preco_loja.required' => 'Preço da loja é obrigatório!',
            'comissao_consultor.required' => 'Defina a comissão do consultor!',
        ];
    }

}
