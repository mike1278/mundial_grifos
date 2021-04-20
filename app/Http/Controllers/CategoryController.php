<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class CategoryController extends Controller
{
    public function create(): Response
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
            return response(['message'=>'Error al crear la categoria','error'=>$e->getMessage()],500);
        }
        return redirect()->back();
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function edit(Category $category): Response
    {
        $category->load('image');
        $categories = Category::whereNull('category_id')->get();
        return Inertia::render('Categories/Edit',compact('category','categories'));
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
