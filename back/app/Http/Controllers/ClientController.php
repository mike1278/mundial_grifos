<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('user')->paginate();
        return Inertia::render('Clients/Index',compact('clients'));
    }

    public function store(Request $request)
    {
        //
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
