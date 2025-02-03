<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnOrderWasCanceled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(private Order $order) {}

    public function broadcastWith(): array
    {
        return ['message' => "O pedido de Nº {$this->order->id} foi cancelado pelo usuário"];
    }

    public function broadcastAs(): string
    {
        return 'order.cancel';
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('order-cancel'.$this->order->establishment_id);
    }
}
