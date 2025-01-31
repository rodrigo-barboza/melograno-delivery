<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class GoogleMapsService
{
    public array $response;

    public function get(string $origin, string $destination): self
    {
        $this->response = Http::get(config('services.google-maps.path'), [
            'origins' => $origin,
            'destinations' => $destination,
            'key' => config('services.google-maps.key'),
        ])->json();

        return $this;
    }

    public function distance(): ?string
    {
        return data_get($this->response, 'rows.0.elements.0.distance.value');
    }
}
