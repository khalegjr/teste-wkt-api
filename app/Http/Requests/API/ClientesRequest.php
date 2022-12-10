<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
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
            'nome' => ['required'],
            'cpf' => ['required', 'max:11'],
            'logradouro' => ['required'],
            'numero' => ['required'],
            'bairro' => ['required'],
            'complemento' => ['nullable', 'max:255'],
            'cidade' => ['required'],
            'cep' => ['required', 'max:9'],
            'email' => ['required', 'email:filter'],
            'data_nascimento' => ['required'],
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
            'cpf' => 'CPF',
            'logradouro' => 'Logradouro',
            'numero' => 'Número',
            'bairro' => 'Bairro',
            'complemento' => 'Complemento',
            'cidade' => 'Cidade',
            'cep' => 'CEP',
            'email' => 'E-Mail',
            'data_nascimento' => 'Data de Nascimento',
        ];
    }
}
