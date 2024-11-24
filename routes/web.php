<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('almacen/categoria', CategoriaController::class);
Route::resource('almacen/producto', ProductoController::class);
Route::resource('ventas/clientes', ClienteController::class);
Route::resource('compras/proveedor', ProveedorController::class);
Route::resource('compras/ingreso', IngresoController::class);
Route::resource('ventas/venta', VentaController::class);
Route::resource('seguridad/usuarios', UsuarioController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
