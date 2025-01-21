<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('cart', fn() => true);

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
