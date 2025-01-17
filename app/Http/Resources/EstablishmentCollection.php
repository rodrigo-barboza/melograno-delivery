<?php

namespace App\Http\Resources;

use App\Models\Establishment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class EstablishmentCollection extends ResourceCollection
{
    public static $wrap = 'establishments';

    public function toArray(Request $request): Collection
    {
        return $this->collection->transform(fn(Establishment $establishment): array => [
            'id'=> $establishment->id,
            'name' => $establishment->name,
            'phone' => $establishment->phone,
            'cep' => $establishment->cep,
            'number' => $establishment->number,
            'address' => $establishment->address,
            'image' => $establishment->image,
            'cover' => $establishment->cover,
            'minimumOrderValue' => $establishment->minimum_order_value,
            'rate' => $establishment->rate,
            'operatingHour' => $establishment->operatingHour ?? null,
            'category' => collect($establishment->categories)->first() ?? null,
            'deliveryAverageTime' => "$establishment->delivery_average_time_min - {$establishment->delivery_average_time_max}min",
        ]);
    }
}
