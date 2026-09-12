<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioApiController extends Controller
{
    // GET /api/usuarios - lista todos los usuarios
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios, 200);
    }

    // POST /api/usuarios - crea un usuario nuevo
    public function store(Request $request)
    {
        $validado = $request->validate([
            'rut' => 'required|string|max:20|unique:users',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users|ends_with:@ventasfix.cl',
            'password' => 'required|string|min:8',
        ]);

        // el password se cifra solo por el cast 'hashed' del modelo User
        $usuario = User::create($validado);

        return response()->json($usuario, 201);
    }

    // GET /api/usuarios/{id} - busca un usuario por su id
    public function show(string $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    // PUT/PATCH /api/usuarios/{id} - actualiza un usuario
    public function update(Request $request, string $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $validado = $request->validate([
            'rut' => 'required|string|max:20|unique:users,rut,' . $usuario->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $usuario->id . '|ends_with:@ventasfix.cl',
            'password' => 'required|string|min:8',
        ]);

        $usuario->update($validado);

        return response()->json($usuario, 200);
    }

    // DELETE /api/usuarios/{id} - elimina un usuario
    public function destroy(string $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(null, 204);
    }
}