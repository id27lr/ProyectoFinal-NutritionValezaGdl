<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{
    public function __construct()
    {
        // Asegura que solo los usuarios con el rol de 'admin' pueden acceder a estas rutas
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $users = User::with('roles')->get();;

        // Si hay un texto de búsqueda
        if ($request->has('texto')) {
            // Obtener el texto de búsqueda
            $texto = trim($request->get('texto'));

            // Filtrar los usuarios por el nombre del usuario
            $users = $users->filter(function ($user) use ($texto) {
                return stripos($user->name, $texto) !== false;
            });
        } else {
            // Si no hay búsqueda, definir el texto vacío
            $texto = '';
        }

        return view('seguridad.roles.index', compact('users', 'texto'));
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Obtener todos los roles disponibles
        return view('seguridad.roles.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Actualizar el rol del usuario
        $user->syncRoles([$request->role]); // Reemplaza todos los roles actuales por el nuevo

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }
}