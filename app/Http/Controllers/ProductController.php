<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\TypeOption;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ProductController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Products/Index', [
            'products' => Product::paginate()
        ]);
    }

    public function create(): InertiaResponse
    {
        $brands = Brand::get();
        $options = TypeOption::with('options')->get();
        return Inertia::render('Products/Create',[
            'categories' => Category::get(),
            'options' => $options,
            'brands' => $brands,
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
