<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrder;
use App\Actions\MarkOrdersAsPaid;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\CartResource;
use App\Http\Services\StripeService;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function index(): Response|RedirectResponse
    {
        $cart_items = Cart::with(['dish' => fn ($query) => $query->with('establishment')])->get();

        if ($cart_items->isEmpty()) {
            return redirect()->route('index');
        }

        return Inertia::render('Checkout/Index', [
            'cartItems' => CartResource::collection(
                Cart::with(['dish' => fn ($query) => $query->with('establishment')])->get()
            ),
        ]);
    }

    public function checkout(
        StoreOrderRequest $request,
        Order $order,
        CreateOrder $action,
        StripeService $service,
    ): JsonResponse {
        $orders = $action->handle($order, $request->validated('orders'), dispatchable: false);

        return response()->json(['url' => $service->createSession($orders)->url]);
    }

    public function success(StripeService $service, MarkOrdersAsPaid $action): Response
    {
        $customer = $service->retrieveCheckoutSession(request('session_id'))->customer_details;
        $orders = Order::where('session_id', request('session_id'))->unpaid()->get();

        throw_if($orders->isEmpty(), NotFoundHttpException::class);

        $action->handle($orders);

        return Inertia::render('Checkout/Success', compact('customer'));
    }

    public function cancel()
    {
        return Inertia::render('Checkout/Cancel');
    }

    public function webhook(StripeService $service, MarkOrdersAsPaid $action): HttpResponse
    {
        $session = $service->checkCheckoutSessionCompletedEvent();
        $orders = Order::where('session_id', $session->id)->unpaid()->get();
        $action->handle($orders);

        return response('', HttpResponse::HTTP_OK);
    }
}
