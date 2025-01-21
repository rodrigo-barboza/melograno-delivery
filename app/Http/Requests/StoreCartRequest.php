<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dish_id' => ['required', 'exists:dishes,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'comments' => ['nullable', 'string'],
        ];
    }
}
