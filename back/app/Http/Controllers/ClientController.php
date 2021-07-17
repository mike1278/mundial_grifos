<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ClientController extends Controller
{
    public function index(): Response
    {
        $clients = Client::with('user')->paginate();
        return Inertia::render('Clients/Index',compact('clients'));
    }

    public function store(Request $request): JsonResponse
    {
        $user = User::create($request->all(['name','email','password']));
        Client::create(array_merge(
            $request->all([
                'lastname',
                'phone',
                'dni',
            ]),
            [
                'user_id' => $user->id,
            ]
        ));
        return response()->json('Su cuenta fue creada exitosamente');
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function edit(Client $client)
    {
        //
    }

    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
    }
}
