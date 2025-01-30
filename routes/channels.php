<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('cart', fn () => true);

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('new-order.{establishment_id}', function (User $user, string $establishment_id): bool {
    return (int) $user->establishment_id === (int) $establishment_id;
});
