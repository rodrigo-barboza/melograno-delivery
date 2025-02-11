<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreSellerRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'business_registration' => ['required', 'string', 'unique:establishments,business_registration'],
            'business_registration_type' => ['required', 'string', Rule::in(['cnpj', 'cpf'])],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'cep' => ['required', 'string'],
            'address' => ['required', 'string'],
            'number' => ['required', 'string'],
            'category' => ['required', 'exists:categories,id'],
            'responsible_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
