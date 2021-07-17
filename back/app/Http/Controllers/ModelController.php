<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModelRequest;
use App\Models\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ModelController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Models/Index', [
            'models' => Model::paginate(10)
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Models/Create');
    }

    public function store(ModelRequest $request): RedirectResponse
    {
        Model::create([
            'name' => $request->name,
        ]);
        return redirect()->route('models.index');
    }

    public function show(Model $model)
    {
        //
    }

    public function edit(Model $model): Response
    {
        return Inertia::render('Models/Edit', compact('model'));
    }

    public function update(Request $request, Model $model): RedirectResponse
    {
        $model->update($request->all(['name']));
        return redirect()->route('models.index');
    }

    public function destroy(Model $model): RedirectResponse
    {
        $model->delete();
        return redirect()->back();
    }
}
