<?php

namespace App\Http\Services;

use App\Enums\PaymentStatusEnum;
use Illuminate\Http\Response;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\StripeObject;
use Stripe\Webhook;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use UnexpectedValueException;

final class StripeService
{
    private StripeClient $stripe;
    private Session $session;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * @param array<int,\App\Models\Order> $orders
     * @return Session
     */
    public function createSession(array $orders): Session
    {
        $this->session = $this->stripe->checkout->sessions->create([
            'line_items' => $this->makeItems($orders),
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        $this->markOrdersAsUnpaid($orders);

        return $this->session;
    }

    public function retrieveCheckoutSession(string $session_id): Session
    {
        try {
            $session = $this->stripe->checkout->sessions->retrieve($session_id);
            throw_if(! $session, NotFoundHttpException::class);
            return $session;
        } catch (ApiErrorException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    public function checkCheckoutSessionCompletedEvent(): Response|StripeObject
    {
        try {
            $event = Webhook::constructEvent(
                payload: @file_get_contents('php://input'),
                sigHeader: $_SERVER['HTTP_STRIPE_SIGNATURE'],
                secret: config('services.stripe.webhook_secret'),
            );
        } catch (UnexpectedValueException $e) {
            return response('', 400);
        } catch (SignatureVerificationException $e) {
            return response('', 400);
        }

        return $event->type === 'checkout.session.completed'
            ? $event->data->object
            : response('', 400);
    }

    private function makeItems(array $orders): array
    {
        foreach ($orders as $order) {
            if ($order->delivery_tax) {
                $items[] = [
                    'price_data' => [
                        'currency' => 'brl',
                        'product_data' => [
                            'name' => 'Entrega',
                        ],
                        'unit_amount' => (int)($order->delivery_tax * 100),
                    ],
                    'quantity' => 1,
                ];
            }

            foreach ($order->items as $item) {
                $items[] = [
                    'price_data' => [
                        'currency' => 'brl',
                        'product_data' => [
                            'name' => data_get($item, 'dish.name'),
                        ],
                        'unit_amount' => data_get($item, 'dish.price') * 100,
                    ],
                    'quantity' => data_get($item, 'quantity'),
                ];
            }
        }

        return $items;
    }

    private function markOrdersAsUnpaid(array $orders): void
    {
        foreach ($orders as $order) {
            $order->update([
                'payment_status' => PaymentStatusEnum::UNPAID->value,
                'session_id' => $this->session->id,
            ]);
        }
    }
}
