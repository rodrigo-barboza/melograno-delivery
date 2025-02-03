<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstablishmentRate extends FormRequest
{
    public function rules(): array
    {
        return [
            'rate' => ['required', 'integer', 'min:0', 'max:5'],
        ];
    }
}
