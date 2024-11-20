<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('almacen/categoria', CategoriaController::class);
Route::resource('almacen/producto', ProductoController::class);
Route::resource('ventas/clientes', ClienteController::class);
Route::resource('compras/proveedor', ProveedorController::class);
Route::resource('compras/ingreso', IngresoController::class);