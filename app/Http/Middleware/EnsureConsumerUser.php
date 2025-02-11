<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureConsumerUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()->isConsumer()) {
            abort(403);
        }

        return $next($request);
    }
}
