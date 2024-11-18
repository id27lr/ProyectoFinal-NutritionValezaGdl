<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoFormRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function __construct()
    {
        // Constructor si es necesario
    }

    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $productos = DB::table('productos as a')
            ->join('categorias as c', 'a.id_categoria', '=', 'c.id')
            ->select('a.id', 'a.nombre', 'a.codigo', 'a.stock', 'c.categoria as categoria', 'a.descripcion', 'a.imagen', 'a.estatus')
            ->where('a.nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('a.codigo', 'LIKE', '%' . $texto . '%')
            ->orderBy('a.id', 'desc')
            ->paginate(10);

        return view('almacen.producto.index', compact('productos', 'texto'));
    }

    public function create()
    {
        $categorias = DB::table('categorias')->where('estatus', '=', '1')->get();
        return view('almacen.producto.create', compact('categorias'));
    }

    public function store(ProductoFormRequest $request)
    {
        $producto = new Producto;
        $producto->id_categoria = $request->input('id_categoria');
        $producto->codigo = $request->input('codigo');
        $producto->nombre = $request->input('nombre');
        $producto->stock = $request->input('stock');
        $producto->descripcion = $request->input('descripcion');
        $producto->estatus = $request->input('estatus', 'Activo');

        // Si el formulario tiene una imagen, manejar la carga de la misma
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreimagen = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
            $ruta = $imagen->storeAs('productos', $nombreimagen, 'public');
            $producto->imagen = 'storage/productos/' . $nombreimagen;
        }

        $producto->save();
        return redirect()->route('producto.index');
    }

    public function show($id)
    {
        // Código para mostrar el detalle de un producto (si lo necesitas)
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = DB::table('categorias')->where('estatus', '=', '1')->get();
        return view('almacen.producto.edit', compact('producto', 'categorias'));
    }

    public function update(ProductoFormRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->id_categoria = $request->input('id_categoria');
        $producto->codigo = $request->input('codigo');
        $producto->nombre = $request->input('nombre');
        $producto->stock = $request->input('stock');
        $producto->descripcion = $request->input('descripcion');

        // Actualización de imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreimagen = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
            $ruta = $imagen->storeAs('productos', $nombreimagen, 'public');
            $producto->imagen = 'storage/productos/' . $nombreimagen;
        }

        $producto->save();
        return redirect()->route('producto.index');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estatus = "Inactivo";
        $producto->save(); 
        return redirect()->route('producto.index');
    }
}
