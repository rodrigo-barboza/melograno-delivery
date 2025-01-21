<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstablishmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'cep' => $this->cep,
            'number' => $this->number,
            'address' => $this->address,
            'image' => $this->image,
            'cover' => $this->cover,
            'minimumOrderValue' => $this->minimum_order_value,
            'rate' => $this->rate,
            'operatingHour' => $this->operatingHour ?? null,
            'category' => collect($this->categories)->first() ?? null,
            'deliveryAverageTime' => "$this->delivery_average_time_min - {$this->delivery_average_time_max}min",
        ];
    }
}
