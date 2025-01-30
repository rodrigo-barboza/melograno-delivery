<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index()
    {
        return Inertia::render('Checkout/Index', [
            'cartItems' => CartResource::collection(
                Cart::with(['dish' => fn ($query) => $query->with('establishment')])->get()
            ),
        ]);
    }
}
