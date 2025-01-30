<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    public function index(): AddressResource
    {
        return AddressResource::make(Address::first());
    }

    public function store(StoreAddressRequest $request): JsonResponse
    {
        $request->user()->address()->create($request->validated());

        return response()->json([
            'message' => 'Endereço cadastrado com sucesso',
            'address' => $request->user()->refresh()->address,
        ], Response::HTTP_CREATED);
    }
}
