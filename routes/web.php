<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchEstablishmentController;
use App\Http\Controllers\Seller\EstablishmentSettingsController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\ShippingTaxController;
use App\Http\Controllers\UpdateEstablishmentRateController;
use App\Http\Middleware\EnsureConsumerUser;
use App\Http\Middleware\EnsureSellerUser;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/establishments/category/{slug_category}', [EstablishmentController::class, 'byCategory'])->name('establishments.by-category');
Route::resource('establishments', EstablishmentController::class)->only(['index', 'show']);
Route::get('/search-establishments', SearchEstablishmentController::class)->name('search-establishments');

Route::get('/categories/{slug_category}', [CategoryController::class, 'index'])->name('categories.index');

Route::middleware(['auth', EnsureConsumerUser::class])->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('carts', CartController::class)->only(['index', 'store', 'destroy', 'update']);
    Route::resource('addresses', AddressController::class)->only(['index', 'store']);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::post('/establishments/{establishment}/{order}/rate', UpdateEstablishmentRateController::class)->name('establishments.rate');

    Route::prefix('checkout')->group(function (): void {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::get('/shipping-cost', [ShippingTaxController::class, 'calculate'])->name('checkout.shipping-cost');
        Route::post('/new-order', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/stripe-new-order', [CheckoutController::class, 'checkout'])->name('checkout.stripe-new-order');
        Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
        Route::get('/retrieve/{order}', [CheckoutController::class, 'retrieveCheckout'])->name('checkout.retrieve');
        Route::post('/webhook', [CheckoutController::class, 'webhook'])
            ->withoutMiddleware(VerifyCsrfToken::class)
            ->name('checkout.webhook');
    });
});

Route::middleware(['auth', EnsureSellerUser::class])
    ->prefix('seller')
    ->name('seller.')
    ->group(function (): void {
        Route::get('/dashboard', [SellerController::class, 'index'])->name('dashboard');
        Route::get('/settings', [EstablishmentSettingsController::class, 'index'])->name('settings');
        Route::get('/settings/update-cover', [EstablishmentSettingsController::class, 'updateCover'])->name('settings.update-cover');
        Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::post('/menu/new-dish', [MenuController::class, 'store'])->name('menu.store');
        Route::post('/menu/update/{dish}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/menu/destroy/{dish}', [MenuController::class, 'destroy'])->name('menu.destroy');
    });

require __DIR__.'/auth.php';
