<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsuarioController extends Controller
{

    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('texto'));
            $usuarios = DB::table('users')
                ->where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->paginate(7);

            return view('seguridad.usuarios.index', ['usuarios' => $usuarios, 'texto' => $query]);
        }
    }

    public function create()
    {
        return view('seguridad.usuarios.create');
    }

    public function store(StoreUsuarioRequest $request)
    {
        // Crear nuevo usuario
        $usuario = new User;

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = Hash::make($request->get('password'));

        $usuario->save();
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }
}
