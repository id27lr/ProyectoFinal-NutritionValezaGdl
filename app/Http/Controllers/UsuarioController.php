<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UsuarioController extends Controller
{

    public function __construct()
    {
        // Asegura que solo los usuarios con el rol de 'admin' pueden acceder a estas rutas
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('texto'));
            $usuarios = DB::table('users')
                ->where('name', 'LIKE', '%' . $query . '%')
                ->where('estatus', '=', '1')
                ->orderBy('id', 'desc')
                ->paginate(7);

            return view('seguridad.usuarios.index', ['usuarios' => $usuarios, 'texto' => $query]);
        }
    }

    public function create()
    {
        return view('seguridad.usuarios.create');
    }

    public function store(UsuarioFormRequest $request)
    {
        // Crear nuevo usuario
        $usuario = new User;

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = Hash::make($request->get('password'));

        $usuario->save();

        Mail::to($usuario->email)->send(new WelcomeMail($usuario));
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('seguridad.usuarios.edit', compact('usuario'));
    }

    public function update(UsuarioFormRequest $request, $id)
    {

        // Actualizar los datos del usuario
        $usuario = User::findOrFail($id);
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = Hash::make($request->get('password'));

        // Guardamos los cambios
        $usuario->save();

        // Redirigir con mensaje de éxito
        return Redirect::to('seguridad/usuarios')->with('success', 'usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estatus = 0;
        $usuario->save(); 
        return redirect()->route('usuarios.index');
    }
}
