<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Brands/Index', [
            'brands' => Brand::paginate()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Brands/Create');
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        Brand::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
    }

    public function show(Brand $brand)
    {
        //
    }

    public function edit(Brand $brand)
    {
        //
    }

    public function update(Request $request, Brand $brand)
    {
        //
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();
        return redirect()->back();
    }
}
