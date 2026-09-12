<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use App\Models\Cliente;

class DashboardController extends Controller
{
    // muestra el dashboard con el conteo de usuarios, productos y clientes
    public function index()
    {
        $totalUsuarios = User::count();
        $totalProductos = Producto::count();
        $totalClientes = Cliente::count();

        return view('index', [
            'totalUsuarios' => $totalUsuarios,
            'totalProductos' => $totalProductos,
            'totalClientes' => $totalClientes,
        ]);
    }
}
