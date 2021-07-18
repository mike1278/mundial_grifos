<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Address;
use App\Models\Client;
use App\Models\Location;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Log;
use Throwable;

class ClientController extends Controller
{
    public function index(): Response
    {
        $clients = Client::with('user')->paginate();
        return Inertia::render('Clients/Index',compact('clients'));
    }

    public function store(ClientRequest $request): JsonResponse
    {
        try{
            $user = User::create($request->all(['name','email','password']));
            $client = Client::create(array_merge(
                $request->all([
                    'lastname',
                    'phone',
                    'dni',
                ]),
                [
                    'user_id' => $user->id,
                ]
            ));
            $location = new Location();
            $location->address = $request->location['address'];
            $location->point = new Point($request->location['lat'],$request->location['lng']);
            $location->save();
            Address::create([
                'client_id' => $client->id,
                'location_id' => $location->id,
            ]);
        }catch (Throwable $e){
            Log::error($e);
            return response()->json(['message' => 'Hubo un error creando su cuenta'],500);
        }
        return response()->json(['message' => 'Su cuenta fue creada exitosamente'],201);
    }

    public function show(Client $client): Response
    {
        $client->load([
            'addresses',
            'addresses.location',
        ]);
        return Inertia::render('Clients/Show',[
            'client' => new ClientResource($client)
        ]);
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
