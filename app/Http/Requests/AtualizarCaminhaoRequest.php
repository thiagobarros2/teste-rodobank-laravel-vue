<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarCaminhaoRequest extends FormRequest
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
            'placa' => [
                'sometimes',
                'required',
                'string',
                'unique:App\Models\Caminhao,placa',
                'size:8',
            ],
            'motorista_id' => [
                'sometimes',
                'required',
                'integer',
            ],
            'modelo_id' => [
                'sometimes',
                'required',
                'integer',
            ],
            'cor' => [
                'sometimes',
                'required',
                'string',
                'max:50',
            ],
            'transportadora_id' => [
                'sometimes',
                'required',
                'integer',
            ],
        ];
    }
}
