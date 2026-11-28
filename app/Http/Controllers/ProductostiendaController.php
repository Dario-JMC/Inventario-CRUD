<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class ProductostiendaController extends Controller
{
    public function store(Request $request, Store $store)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:120',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ]);

        $store->productos()->create([
            'nombre' => $data['nombre'],
            'precio' => $data['precio'],
            'stock'  => $data['stock'],
            'activo' => $request->has('activo'),
        ]);

        return redirect()->route('stores.show', $store)->with('success', 'Producto agregado a la tienda.');
    }
}