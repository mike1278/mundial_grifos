<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Storage;
use Throwable;

class CategoryController extends Controller
{
    public function index(): InertiaResponse
    {
        $categories = Category::with('image')->paginate();
        return Inertia::render('Categories/Index', compact('categories'));
    }

    public function create(): InertiaResponse
    {
        $categories = Category::whereNull('category_id')->get();
        return Inertia::render('Categories/Create',[
            'categories' => $categories,
        ]);
    }

    public function store(CategoryRequest $request)
    {
        try{
            DB::beginTransaction();
            $category = Category::create($request->only(['name','category_id']));
            $category->image()->create([
                'url' => $request->file('image')->store('/','public'),
            ]);
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
            return response(['message'=>'Error al crear la categoría','error'=>$e->getMessage()],500);
        }
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function edit(Category $category): InertiaResponse
    {
        $category->load('image');
        $categories = Category::whereNull('category_id')->get();
        return Inertia::render('Categories/Edit',compact('category','categories'));
    }

    public function update(Request $request, Category $category)
    {
        try{
            DB::beginTransaction();
            $category->update($request->only(['name','category_id']));
            if($request->image){
                $image = $category->image()->first();
                Storage::delete($image->url);
                $image->delete();
                $category->image()->create([
                    'url' => $request->file('image')->store('/','public'),
                ]);
            }
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
            return response(['message'=>'Error al crear la categoría','error'=>$e->getMessage()],500);
        }
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
