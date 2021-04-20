<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(ImageRequest $request)
    {
        return $request->file('image')->store('/temp','public');
    }

    public function show(File $file)
    {
        //
    }

    public function edit(File $file)
    {
        //
    }

    public function update(Request $request, File $file)
    {
        //
    }

    public function destroy(File $file)
    {
        //
    }
}
