<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
}
