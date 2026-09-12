<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteApiController extends Controller
{
    // GET /api/clientes - lista todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes, 200);
    }

    // POST /api/clientes - crea un cliente nuevo
    public function store(Request $request)
    {
        $validado = $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:clientes',
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        $cliente = Cliente::create($validado);

        return response()->json($cliente, 201);
    }

    // GET /api/clientes/{id} - busca un cliente por su id
    public function show(string $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['mensaje' => 'Cliente no encontrado'], 404);
        }

        return response()->json($cliente, 200);
    }

    // PUT/PATCH /api/clientes/{id} - actualiza un cliente
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['mensaje' => 'Cliente no encontrado'], 404);
        }

        $validado = $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:clientes,rut_empresa,' . $cliente->id,
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        $cliente->update($validado);

        return response()->json($cliente, 200);
    }

    // DELETE /api/clientes/{id} - elimina un cliente
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['mensaje' => 'Cliente no encontrado'], 404);
        }

        $cliente->delete();

        return response()->json(null, 204);
    }
}
