<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    $empleados = Empleado::paginate(1);
    return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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


    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    $empleado = Empleado::findOrFail($id);
    return view('empleado.edit', compact('empleado'));

    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $campos = [
        'nombre' => 'required|string|max:100',
        'apellido_paterno' => 'required|string|max:100',
        'apellido_materno' => 'required|string|max:100',
        'email' => 'required|email',
        'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];
    $mensaje = [
        'required' => 'El :attribute es requerido',
    ];

    if ($request->hasFile('foto')) {
        $campos['foto'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $mensaje['foto.required'] = 'La foto es requerida';
    }

    $this->validate($request, $campos, $mensaje);

    $empleado = Empleado::findOrFail($id);
    $datosEmpleado = $request->except(['_token','_method']);

    if ($request->hasFile('foto')) {
        if ($empleado->foto) {
            Storage::disk('public')->delete($empleado->foto);
        }
        $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');
    }

    $empleado->update($datosEmpleado);

    return redirect('empleado')->with('success', 'Empleado actualizado correctamente');
} // <-- aquí cierras bien el método


    /**
     * Remove the specified resource from storage.
     */
public function destroy(Empleado $empleado)
{
    if ($empleado->foto) {
        Storage::disk('public')->delete($empleado->foto);
    }

    $empleado->delete();

    return redirect('empleado')->with('success', 'Empleado eliminado correctamente');
}

}
