<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // lista todos los productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos', ['productos' => $productos]);
    }

    // guarda un producto nuevo
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:50|unique:productos',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'imagen' => 'required|string',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        $datos = $request->all();

        // calculamos el precio de venta solo, con el 19% de iva sobre el precio neto
        $datos['precio_venta'] = $request->precio_neto * 1.19;

        Producto::create($datos);

        return redirect('/productos');
    }

    // muestra el formulario de editar
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos-edit', ['producto' => $producto]);
    }

    // actualiza un producto existente
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'sku' => 'required|string|max:50|unique:productos,sku,' . $producto->id,
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'imagen' => 'required|string',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        $datos = $request->all();

        // recalculamos el precio de venta cada vez que se actualiza el precio neto
        $datos['precio_venta'] = $request->precio_neto * 1.19;

        $producto->update($datos);

        return redirect('/productos');
    }

    // elimina un producto
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect('/productos');
    }
}