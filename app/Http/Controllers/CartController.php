<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index(): JsonResource
    {
        return CartResource::collection(Cart::with('dish')->get());
    }

    public function store(StoreCartRequest $request): JsonResponse
    {
        $request->user()->carts()->create($request->validated());

        return response()->json([
            'message' => 'Produto adicionado ao carrinho',
        ], Response::HTTP_CREATED);
    }
}
