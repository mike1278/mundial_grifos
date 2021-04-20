<?php

namespace App\Actions\Category;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class Index
{
    use AsAction;

    public function handle(): LengthAwarePaginator
    {
        return Category::with('image')->paginate();
    }

    public function asController(): LengthAwarePaginator
    {
        return $this->handle();
    }

    public function htmlResponse($categories): Response
    {
        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function jsonResponse($categories): AnonymousResourceCollection
    {
        return CategoryResource::collection($categories);
    }
}
