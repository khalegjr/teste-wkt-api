<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest
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
            'valor_unitario' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => "O campo :attribute é obrigatório!",
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'valor_unitario' => 'Valor Unitário',
        ];
    }
}
