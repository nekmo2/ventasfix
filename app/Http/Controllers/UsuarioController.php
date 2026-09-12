<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // lista todos los usuarios en la vista del backoffice
    public function index()
    {
        $usuarios = User::all();
        return view('users', ['usuarios' => $usuarios]);
    }

    // guarda un usuario nuevo creado desde el modal "Add User"
    public function store(Request $request)
    {
        $request->validate([
            'rut' => 'required|string|max:20|unique:users',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|ends_with:@ventasfix.cl',
            'password' => 'required|string|min:8',
        ]);

        // el password se cifra solo gracias al cast 'hashed' del modelo User
        User::create($request->all());

        return redirect('/users');
    }

    // muestra el formulario para editar un usuario
    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);
        return view('users-edit', ['usuario' => $usuario]);
    }

    // actualiza los datos de un usuario existente
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'rut' => 'required|string|max:20|unique:users,rut,' . $usuario->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id . '|ends_with:@ventasfix.cl',
        ]);

        // actualizamos los datos basicos
        $usuario->rut = $request->rut;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;

        // el password solo se actualiza si el usuario escribio uno nuevo
        if ($request->filled('password')) {
            $usuario->password = $request->password;
        }

        $usuario->save();

        return redirect('/users');
    }

    // elimina un usuario
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect('/users');
    }
}