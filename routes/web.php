<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;


Route::middleware('auth')->group(function () {
    
    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('almacen/categoria', CategoriaController::class);
    Route::resource('almacen/producto', ProductoController::class);
    Route::resource('ventas/clientes', ClienteController::class);
    Route::resource('compras/proveedor', ProveedorController::class);
    Route::resource('compras/ingreso', IngresoController::class);
    Route::resource('ventas/venta', VentaController::class);

    Route::group(['middleware' => ['role:admin']], function () {
        
        Route::resource('seguridad/usuarios', UsuarioController::class);
        Route::resource('seguridad/roles', UserRoleController::class);
        
        Route::get('seguridad/usuarios/{user}/roles', [UserRoleController::class, 'edit'])->name('seguridad.roles.edit');
        Route::put('seguridad/usuarios/{user}/roles', [UserRoleController::class, 'update'])->name('seguridad.roles.update');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
});

Auth::routes();