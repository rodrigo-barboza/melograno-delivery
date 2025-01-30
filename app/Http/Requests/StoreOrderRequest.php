<?php

namespace App\Http\Requests;

use App\Enums\DeliveryTypeEnum;
use App\Enums\PaymentTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'orders' => ['required', 'array'],
            'orders.*.address' => ['required', 'string'],
            'orders.*.delivery_tax' => ['nullable', 'numeric'],
            'orders.*.delivery_type' => ['required', 'string', Rule::in(values: DeliveryTypeEnum::values())],
            'orders.*.payment_type' => ['required', 'string', Rule::in(values:PaymentTypeEnum::values())],
            'orders.*.establishment_id' => ['required', 'numeric', 'exists:establishments,id'],
            'orders.*.instructions' => ['nullable', 'string'],
            'orders.*.items' => ['required', 'array'],
            'orders.*.items.*.dish.id' => ['required', 'numeric', 'exists:dishes,id'],
            'orders.*.items.*.dish.category_id' => ['required', 'numeric', 'exists:categories,id'],
            'orders.*.items.*.dish.name' => ['required', 'string'],
            'orders.*.items.*.dish.description' => ['required', 'string'],
            'orders.*.items.*.dish.image' => ['required', 'string'],
            'orders.*.items.*.dish.price' => ['required', 'numeric'],
            'orders.*.items.*.quantity' => ['required', 'integer', 'min:1'],
            'orders.*.items.*.comment' => ['nullable', 'string'],
        ];
    }
}
