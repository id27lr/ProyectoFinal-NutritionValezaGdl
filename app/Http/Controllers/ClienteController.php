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
            $clientes = DB::table('personas') // Usamos la tabla 'personas'
                ->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('tipo_persona', '=', 'Cliente') // Filtramos solo clientes
                ->orderBy('id', 'desc') // Ordenamos por 'id_persona'
                ->paginate(7);

            return view('ventas.clientes.index', ['clientes' => $clientes, 'texto' => $query]);
        }
    }

    public function create()
    {
        return view('ventas.clientes.create');
    }

    public function store(ClienteFormRequest $request)
    {
        $cliente = new Cliente;
        $cliente->tipo_persona = 'Cliente';
        $cliente->nombre = $request->get('nombre');
        $cliente->tipo_documento = $request->get('tipo_documento');
        $cliente->num_documento = $request->get('num_documento');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');
        $cliente->save();

        return Redirect::to('ventas/clientes');
    }

    public function show($id)
    {
        return view('ventas.clientes.show', ['cliente' => Cliente::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('ventas.clientes.edit', ['cliente' => Cliente::findOrFail($id)]);
    }

    public function update(ClienteFormRequest $request, $id)
    {
        // Obtén el cliente con el ID
        $cliente = Cliente::findOrFail($id);

        // Actualiza los campos del cliente
        $cliente->nombre = $request->get('nombre');
        $cliente->tipo_documento = $request->get('tipo_documento');
        $cliente->num_documento = $request->get('num_documento');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');

        // Guarda los cambios en la base de datos
        $cliente->save();

        // Redirige a la lista de clientes con mensaje de éxito
        return Redirect::to('ventas/clientes')
            ->with('success', 'Cliente actualizado correctamente');
    }


    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->estatus = '0';
        $cliente->update();

        return Redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente');
    }
}
