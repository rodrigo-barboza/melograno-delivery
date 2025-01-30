<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'street' => $this->name,
            'neighborhood' => $this->neighborhood,
            'number' => $this->number,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'complement' => $this->complement,
        ];
    }
}
