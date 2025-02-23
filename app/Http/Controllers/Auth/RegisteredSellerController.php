<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\StoreSellerRegisterRequest;
use App\Models\EstablishmentCategory;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredSellerController
{
    public function create(): Response
    {
        return Inertia::render('Auth/SellerRegister', [
            'categories' => EstablishmentCategory::get()
                ->unique('name')
                ->map(fn(EstablishmentCategory $category): array => [
                    'label'=> $category->name,
                    'value' => $category->id,
                ]),
        ]);
    }

    public function store(StoreSellerRegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->responsible_name,
            'email' => $request->email,
            'cover' => '',
            'password' => bcrypt($request->password),
            'role' => 'seller',
        ]);

        $user->establishment()->create([
            'name' => $request->name,
            'category_id' => $request->category,
            'business_registration' => $request->business_registration,
            'business_registration_type' => $request->business_registration_type,
            'phone' => $request->phone,
            'cep' => $request->cep,
            'address' => $request->address,
            'number' => $request->number,
            'image' => '/images/placeholder-b.png',
            'cover' => '/images/placeholder-a.svg',
            'minimum_order_value' => 0,
            'rate' => 0,
            'delivery_average_time_min' => 0,
            'delivery_average_time_max'=> 0,
        ]);

        Auth::login($user);

        return redirect(route('seller.dashboard', absolute: false));
    }
}
