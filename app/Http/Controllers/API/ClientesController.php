<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ClientesRequest;
use App\Http\Requests\API\UpdateClientesRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct(private Cliente $client)
    {

    }

    public function index(Cliente $client)
    {
        return response()->json($client->all());
    }

    public function show($id)
    {
        $client = $this->client->findOrFail($id);

        return response()->json($client);
    }

    public function store(ClientesRequest $request)
    {
        $client = $this->client->create($request->all());

        return response()->json($client, 201);
    }

    public function update($id, UpdateClientesRequest $request)
    {
        $client = $this->client->find($id);

        $client->update($request->all());

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = $this->client->find($id);

        $client->delete();

        return response()->json([], 204);
    }
}
