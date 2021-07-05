<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Model;
use App\Models\Product;
use App\Services\ManageFile;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Log;
use Throwable;

class ProductController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Products/Index', [
            'products' => Product::with(['images'])->paginate(12)
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Products/Create',[
            'categories' => Category::get(),
            'colors' => Color::with('image')->get(),
            'models' => Model::get(),
            'brands' => Brand::get(),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        try{
            DB::beginTransaction();
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'discount' => $request->discount,
                'published' => $request->published,
                'serial_code' => $request->serial_code,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'model_id' => $request->model_id,
                'brand_id' => $request->brand_id,
                'currency_id' => Currency::where('acronym','$')->first()->id,
            ]);
            $product->colors()->attach($request->colors);
            foreach ($request->images as $image){
                $product->images()->create([
                    'url' => ManageFile::saveTemporal($image),
                ]);
            }
            DB::commit();
        }catch (Throwable $e){
            Log::error($e);
            DB::rollBack();
        }
        return redirect()->back();
    }

    public function show(Product $product): InertiaResponse
    {
        $product->load(['model','brand','images','category','colors','colors.image']);
        return Inertia::render('Products/Show', [
            'product' => $product
        ]);
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
        $product->delete();
    }
}
