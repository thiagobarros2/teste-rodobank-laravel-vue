<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MotoristaMaiorDeIdade implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dataNascimento = Carbon::createFromFormat('d-m-Y', $value);
        $hoje = now();
        $idade = $hoje->diff($dataNascimento)->y;
        if ($idade < 18) {
            $fail('O campo :attribute não é uma data de nascimento válida para motorista maior de idade.');
        }
    }
}
