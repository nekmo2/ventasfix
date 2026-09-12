<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoApiController extends Controller
{
    // GET /api/productos - lista todos los productos
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    // POST /api/productos - crea un producto nuevo
    public function store(Request $request)
    {
        $validado = $request->validate([
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

        // calculamos el precio de venta con el 19% de iva
        $validado['precio_venta'] = $validado['precio_neto'] * 1.19;

        $producto = Producto::create($validado);

        return response()->json($producto, 201);
    }

    // GET /api/productos/{id} - busca un producto por su id
    public function show(string $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto, 200);
    }

    // PUT/PATCH /api/productos/{id} - actualiza un producto
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }

        $validado = $request->validate([
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

        $validado['precio_venta'] = $validado['precio_neto'] * 1.19;

        $producto->update($validado);

        return response()->json($producto, 200);
    }

    // DELETE /api/productos/{id} - elimina un producto
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(null, 204);
    }
}
