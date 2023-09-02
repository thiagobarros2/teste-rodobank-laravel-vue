<?php

namespace App\Http\Requests;

use App\Rules\CPF;
use App\Rules\MotoristaMaiorDeIdade;
use Illuminate\Foundation\Http\FormRequest;

class AtualizarMotoristaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => [
                'bail',
                'sometimes',
                'required',
                'string',
                'max:100',
            ],
            'cpf' => [
                'bail',
                'sometimes',
                'numeric',
                'digits:11',
               // 'unique:App\Models\Motorista,cpf',
                new CPF,
            ],
            'data_nascimento' => [
                'bail',
                'sometimes',
                'date_format:d-m-Y',
                new MotoristaMaiorDeIdade,
            ],
            'email' => [
                'bail',
                'sometimes',
                'email',
            ],
            'transportadora_id' => [
                'bail',
                'sometimes',
                'integer',
            ],
        ];
    }
}
