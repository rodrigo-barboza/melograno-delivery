<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingTaxController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::resource('establishments', EstablishmentController::class)->only(['index', 'show']);

Route::get('categories/{categories:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('carts', CartController::class)->only(['index', 'store', 'destroy', 'update']);
    Route::resource('addresses', AddressController::class)->only(['index', 'store']);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::prefix('checkout')->group(function (): void {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::get('/shipping-cost', [ShippingTaxController::class, 'calculate'])->name('checkout.shipping-cost');
        Route::post('/new-order', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/stripe-new-order', [CheckoutController::class,'checkout'])->name('checkout.stripe-new-order');
        Route::get('/success', [CheckoutController::class,'success'])->name('checkout.success');
        Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
        Route::post('/webhook', [CheckoutController::class, 'webhook'])
            ->withoutMiddleware(VerifyCsrfToken::class)
            ->name('checkout.webhook');
    });
});

require __DIR__.'/auth.php';
