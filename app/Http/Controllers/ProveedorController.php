<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorFormRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class proveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('texto'));
            // Filtramos proveedor activos (estatus = 1)
            $proveedor = DB::table('personas')
                ->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('tipo_persona', '=', 'proveedor') // Solo proveedores
                ->where('estatus', '=', '1') // Solo proveedores activos
                ->orderBy('id', 'desc') // Ordenamos por id
                ->paginate(7);

            return view('compras.proveedor.index', ['proveedor' => $proveedor, 'texto' => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para crear proveedor
        return view('compras.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProveedorFormRequest $request)
    {
        // Crear nuevo proveedor
        $proveedor = new Proveedor;
        $proveedor->tipo_persona = 'Proveedor';
        $proveedor->nombre = $request->get('nombre');
        $proveedor->tipo_documento = $request->get('tipo_documento');
        $proveedor->num_documento = $request->get('num_documento');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $proveedor->estatus = 1; // Establecemos que el proveedor está activo
        $proveedor->save();

        return Redirect::to('compras/proveedor')->with('success','Proveedor creado exitosamente');;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mostrar detalles del proveedor
        return view('compras.provedor.show', ['proveedor' => Proveedor::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mostrar formulario de edición del proveedor
        return view('compras.proveedor.edit', ['proveedor' => Proveedor::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProveedorFormRequest $request, $id)
    {
        // Actualizar los datos del proveedor
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre = $request->get('nombre');
        $proveedor->tipo_documento = $request->get('tipo_documento');
        $proveedor->num_documento = $request->get('num_documento');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');

        // Guardamos los cambios
        $proveedor->save();

        // Redirigir con mensaje de éxito
        return Redirect::to('compras/proveedor')
            ->with('success', 'Proveedor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cambiar el estatus del proveedor a '0' (eliminado)
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->estatus = '0'; // Marcar como eliminado
        $proveedor->save(); // Guardar el cambio

        return Redirect()->route('proveedor.index')
            ->with('success', 'Proveedor eliminado correctamente');
    }
}
