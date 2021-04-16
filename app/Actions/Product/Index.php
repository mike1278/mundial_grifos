<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class Index
{
    use AsAction;

    public function handle(): LengthAwarePaginator
    {
        return Product::paginate();
    }

    public function asController(): LengthAwarePaginator
    {
        return $this->handle();
    }

    public function htmlResponse($products): Response
    {
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }
}
