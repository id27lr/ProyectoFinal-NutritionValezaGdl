<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('texto'));
            // Filtramos clientes activos (estatus = 1)
            $clientes = DB::table('personas')
                ->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('tipo_persona', '=', 'Cliente') // Solo clientes
                ->where('estatus', '=', '1') // Solo clientes activos
                ->orderBy('id', 'desc') // Ordenamos por id
                ->paginate(7);

            return view('ventas.clientes.index', ['clientes' => $clientes, 'texto' => $query]);
        }
    }

    public function create()
    {
        // Mostrar formulario para crear cliente
        return view('ventas.clientes.create');
    }

    public function store(ClienteFormRequest $request)
    {
        // Crear nuevo cliente
        $cliente = new Cliente;
        $cliente->tipo_persona = 'Cliente';
        $cliente->nombre = $request->get('nombre');
        $cliente->tipo_documento = $request->get('tipo_documento');
        $cliente->num_documento = $request->get('num_documento');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');
        $cliente->estatus = 1; // Establecemos que el cliente está activo
        $cliente->save();

        return Redirect::to('ventas/clientes');
    }

    public function show($id)
    {
        // Mostrar detalles del cliente
        return view('ventas.clientes.show', ['cliente' => Cliente::findOrFail($id)]);
    }

    public function edit($id)
    {
        // Mostrar formulario de edición del cliente
        return view('ventas.clientes.edit', ['cliente' => Cliente::findOrFail($id)]);
    }

    public function update(ClienteFormRequest $request, $id)
    {
        // Actualizar los datos del cliente
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->tipo_documento = $request->get('tipo_documento');
        $cliente->num_documento = $request->get('num_documento');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');

        // Guardamos los cambios
        $cliente->save();

        // Redirigir con mensaje de éxito
        return Redirect::to('ventas/clientes')
            ->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy($id)
    {
        // Cambiar el estatus del cliente a '0' (eliminado)
        $cliente = Cliente::findOrFail($id);
        $cliente->estatus = '0'; // Marcar como eliminado
        $cliente->save(); // Guardar el cambio

        return Redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente');
    }
}
