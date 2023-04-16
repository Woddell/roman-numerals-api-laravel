<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RomanNumeralConversionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'input' => ['required', 'integer', 'min:1', 'max:3999'],
        ];
    }
}
