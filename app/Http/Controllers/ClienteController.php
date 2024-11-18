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
        $cliente = Cliente::findOrFail($id);
        $cliente->tipo_persona = $request->get('tipo_persona');
        $cliente->nombre = $request->get('nombre');
        $cliente->tipo_documento = $request->get('tipo_documento');
        $cliente->num_documento = $request->get('num_documento');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');
        $cliente->update();

        return Redirect::to('ventas/clientes');
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
