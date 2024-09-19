<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $productos = Producto::orderBy('nombre')->get();
            return response()->json(['status' => 'success', 'data' => $productos]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'codigo' => 'required|string|unique:productos,codigo',
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'categoria' => 'required|in:calzado,ropa,joyería',
                'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ]);

            $producto = Producto::create($request->all());
            return response()->json(['status' => 'success', 'data' => $producto]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $producto = Producto::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $producto]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'codigo' => 'string|unique:productos,codigo,' . $id,
                'nombre' => 'string|max:255',
                'descripcion' => 'string',
                'categoria' => 'in:calzado,ropa,joyería',
                'precio' => 'numeric|min:0',
                'stock' => 'integer|min:0',
            ]);

            $producto = Producto::findOrFail($id);
            $producto->update($request->all());

            return response()->json(['status' => 'success', 'data' => $producto]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();

            return response()->json(['status' => 'success', 'message' => 'Producto eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
