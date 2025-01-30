<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderWasCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        protected Order $order,
    )
    {
    }

    public function broadcastWith(): array
    {
        return ['message' => "Novo pedido criado, Nº {$this->order->id}"];
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("new-order.{$this->order->establishment_id}"),
        ];
    }
}
