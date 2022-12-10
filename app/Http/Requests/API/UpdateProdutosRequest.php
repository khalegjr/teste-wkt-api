<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutosRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['sometimes', 'required'],
            'valor_unitario' => ['sometimes', 'required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => "O campo :attribute é obrigatório!",
            'max' => 'O campo :attribute excedeu o tamanho! Seu tamanho máximo é de :value caracteres.',
            'email' => "E-mail inválido!"
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'cpf' => 'Valor Unitário',
        ];
    }
}
