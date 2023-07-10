<?php

namespace App\Http\Requests;

use App\Enum\TransportadoraStatus;
use App\Rules\CNPJ;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AtualizarTransportadoraRequest extends FormRequest
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
                'sometimes',
                'required',
                'string',
                'max:100',
            ],
            'cnpj' => [
                'sometimes',
                'required',
                'numeric',
                'digits:14',
                'unique:App\Models\Transportadora,cnpj',
                new CNPJ,
            ],
            'status' => [
                'sometimes',
                'required',
                'integer',
                Rule::in(
                    TransportadoraStatus::ATIVADO->status(),
                    TransportadoraStatus::INATIVADO->status()
                ),
            ],
        ];
    }
}
