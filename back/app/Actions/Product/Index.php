<?php

namespace App\Actions\Product;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Index
{
    use AsAction;

    public function handle()
    {
        return QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('category','category_id'),
                AllowedFilter::exact('brand','brand_id'),
                AllowedFilter::exact('model','model_id'),
                'published',
            ])
            ->with(['images','colors'])
            ->paginate();
    }
}
