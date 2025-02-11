<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

final class MenuController
{
    public function index(): Response
    {
        return Inertia::render('Seller/Menu/Index');
    }
}
