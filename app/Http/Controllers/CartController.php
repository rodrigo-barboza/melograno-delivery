<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
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
        $request->user()->carts()->updateOrCreate(
            ['dish_id' => $request->dish_id],
            $request->validated(),
        );

        return response()->json([
            'message' => 'Produto adicionado ao carrinho',
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateCartRequest $request, Cart $cart): JsonResponse
    {
        $cart->update($request->validated());

        return response()->json([
            'message'=> 'Produto atualizado no carrinho',
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy(Cart $cart): JsonResponse
    {
        $cart->delete();

        return response()->json([
            'message' => 'Produto removido do carrinho',
        ], Response::HTTP_NO_CONTENT);
    }
}
