<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ColorController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Colors/Index', [
            'colors' => Color::with('image')->paginate()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Colors/Create');
    }

    public function store(ColorRequest $request): RedirectResponse
    {
        Color::create([
            'name' => $request->name,
        ])->image()->create([
            'url' => $request->file('image')->store('/','public'),
        ]);
        return redirect()->back();
    }

    public function show(Color $color)
    {
        //
    }

    public function edit(Color $color)
    {
        //
    }

    public function update(Request $request, Color $color)
    {
        //
    }

    public function destroy(Color $color): RedirectResponse
    {
        $color->delete();
        return redirect()->back();
    }
}
