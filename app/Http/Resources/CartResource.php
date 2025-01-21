<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dish' => $this->whenLoaded('dish', $this->dish),
            'quantity' => $this->quantity,
        ];
    }
}
