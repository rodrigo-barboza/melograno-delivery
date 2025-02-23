<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use App\Http\Services\S3Service;
use App\Models\Category;
use App\Models\Establishment;
use Exception;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

final class MenuController
{
    public function index(S3Service $service): Response
    {
        $dishes = Establishment::first()
            ->dishes()
            ->with('category')
            ->get()
            ->map(function($dish) use ($service) {
                return array_merge(
                    $dish->toArray(),
                    ['image' => $service->getTemporaryUrl($dish->image)],
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
            $path = Storage::disk('s3')
                ->putFile('dishes', $request->file('image'));

            if (! Storage::disk('s3')->exists($path)) {
                throw new RuntimeException('Falha ao salvar o arquivo');
            }

            Establishment::first()->dishes()->create(array_merge(
                $request->validated(),
                ['image' => $path],
            ));
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }

        return response(HttpResponse::HTTP_CREATED);
    }
}
