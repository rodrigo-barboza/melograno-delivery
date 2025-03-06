<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Services\S3Service;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Establishment;
use Exception;
use Inertia\Inertia;
use Inertia\Response;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

final class MenuController
{
    public function __construct(private S3Service $service)
    {
    }

    public function index(): Response
    {
        $dishes = Establishment::first()
            ->dishes()
            ->with('category')
            ->get()
            ->map(function($dish): array {
                return array_merge(
                    $dish->toArray(),
                    ['image' => $this->service->getTemporaryUrl($dish->image)],
                );
            });

        return Inertia::render('Seller/Menu/Index', [
            'dishes' => $dishes,
            'categories' => Category::query()->get(['id', 'name']),
        ]);
    }

    public function store(StoreDishRequest $request): HttpResponse
    {
        try {
            $path = $this->service->saveFile($request->file('image'));

            Establishment::first()
                ->dishes()
                ->create(array_merge(
                    $request->validated(),
                    ['image' => $path]
                ));
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }

        return response(HttpResponse::HTTP_CREATED);
    }

    public function update(UpdateDishRequest $request, Dish $dish): HttpResponse
    {
        try {
            $path = $request->hasFile('image')
                ? $this->service->updateFile($request->file('image'), $dish->image)
                : $dish->image;

            $dish->update(array_merge($request->validated(), ['image' => $path]));
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }

        return response(HttpResponse::HTTP_OK);
    }

    public function destroy(Dish $dish): HttpResponse
    {
        $dish->delete();

        return response(HttpResponse::HTTP_NO_CONTENT);
    }
}
