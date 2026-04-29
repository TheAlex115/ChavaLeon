<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

public function index(Request $request)
{
    $query = Producto::query();

    // Filtros de búsqueda
    if ($request->filled('search')) {
        $query->where('nombre', 'like', '%'.$request->search.'%');
    }

    if ($request->filled('categoria')) {
        $query->where('categoria', $request->categoria);
    }

    // Ordenamiento dinámico
    if ($request->filled('sort')) {
        $query->orderBy($request->sort, 'asc');
    }

    $productos = $query->paginate(10);

    return view('producto.index', compact('productos'));
}
    public function create()
    {
        return view('producto.create');
    }

    public function store(Request $request)
    {
        $campos = [
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $this->validate($request, $campos);

        $datosProducto = $request->except('_token');

        if ($request->hasFile('foto')) {
            $datosProducto['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Producto::create($datosProducto);

        return redirect('producto')->with('success', 'Producto agregado correctamente');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $campos = [
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $this->validate($request, $campos);

        $datosProducto = $request->except(['_token','_method']);

        if ($request->hasFile('foto')) {
            $producto = Producto::findOrFail($id);
            Storage::delete('public/'.$producto->foto);
            $datosProducto['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Producto::where('id','=',$id)->update($datosProducto);

        return redirect('producto')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->foto) {
            Storage::delete('public/'.$producto->foto);
        }

        $producto->delete();

        return redirect('producto')->with('success', 'Producto eliminado correctamente');
    }

    public function show($id)
{
    $producto = Producto::findOrFail($id);
    return view('producto.show', compact('producto'));
}

}
