<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function store(StoreCartRequest $request): JsonResponse
    {
        $request->user()->carts()->create($request->validated());

        return response()->json([
            'message' => 'Produto adicionado ao carrinho',
        ], JsonResponse::HTTP_CREATED);
    }
}
