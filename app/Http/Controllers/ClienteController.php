<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // lista todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes', ['clientes' => $clientes]);
    }

    // guarda un cliente nuevo
    public function store(Request $request)
    {
        $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:clientes',
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        Cliente::create($request->all());

        return redirect('/clientes');
    }

    // muestra el formulario de editar
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes-edit', ['cliente' => $cliente]);
    }

    // actualiza un cliente existente
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:clientes,rut_empresa,' . $cliente->id,
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        $cliente->update($request->all());

        return redirect('/clientes');
    }

    // elimina un cliente
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect('/clientes');
    }
}
