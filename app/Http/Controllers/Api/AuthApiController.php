<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // login de la api: valida credenciales y devuelve un token de acceso
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = User::where('email', $request->email)->first();

        // si no existe el usuario o la clave no coincide, devolvemos 401 (no autorizado)
        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json(['mensaje' => 'Credenciales incorrectas'], 401);
        }

        // creamos un token nuevo para este usuario
        $token = $usuario->createToken('token_api')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token' => $token,
        ], 200);
    }

    // logout de la api: elimina el token actual
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['mensaje' => 'Sesion cerrada'], 200);
    }
}
