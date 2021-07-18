<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->load(['client','roles','permissions']);
        if($user->client){
            $user->load([
                'client.addresses',
                'client.addresses.location',
            ]);
        }
        return response()->json(new MeResource($user));
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
