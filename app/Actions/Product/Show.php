<?php

namespace App\Actions\Product;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class Show
{
    use AsAction;

    public function asController(Product $product): Product
    {
        return $product;
    }

    public function htmlResponse($product): Response
    {
        return Inertia::render('Products/Show', [
            'product' => $product
        ]);
    }

    public function jsonResponse($product): ProductResource
    {
        return new ProductResource($product);
    }
}
