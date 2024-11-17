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
        $productos = DB::table('productos as a') // Usar 'productos' en vez de 'producto'
            ->join('categorias as c', 'a.id_categoria', '=', 'c.id') // Usar 'categorias' en vez de 'categoria'
            ->select('a.id', 'a.nombre', 'a.codigo', 'a.stock', 'c.nombre as categoria', 'a.descripcion', 'a.imagen', 'a.estado')
            ->where('a.nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('a.codigo', 'LIKE', '%' . $texto . '%')
            ->orderBy('a.id', 'desc')
            ->paginate(10);

        return view('almacen.producto.index', compact('productos', 'texto'));
    }

    public function create()
    {
        $categorias = DB::table('categorias')->where('estatus', '=', '1')->get(); // Usar 'categorias' en vez de 'categoria'
        return view("almacen.producto.create", ["categorias" => $categorias]);
    }

    public function store(ProductoFormRequest $request)
    {
        $producto = new Producto;
        $producto->id_categoria = $request->input('id_categoria'); // Asegúrate de que estás usando 'id_categoria'
        $producto->codigo = $request->input('codigo');
        $producto->nombre = $request->input('nombre');
        $producto->stock = $request->input('stock');
        $producto->descripcion = $request->input('descripcion');
        $producto->estado = $request->input('estado'); // 'Activo' no está definido, usa lo que venga del request

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreimagen = Str::slug($request->nombre) . "." . $imagen->guessExtension();
            $ruta = public_path("/imagenes/productos/");

            // Guarda la imagen en la ruta especificada
            $imagen->move($ruta, $nombreimagen);

            $producto->imagen = $nombreimagen;
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
        $categorias = DB::table('categorias')->where('estatus', '=', '1')->get(); // Usar 'categorias'
        return view("almacen.producto.edit", compact('producto', 'categorias')); // Corregir la forma de pasar datos
    }

    public function update(ProductoFormRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->id_categoria = $request->input('id_categoria');
        $producto->codigo = $request->input('codigo');
        $producto->nombre = $request->input('nombre');
        $producto->stock = $request->input('stock');
        $producto->descripcion = $request->input('descripcion');

        if ($request->hasFile("imagen")) {
            $imagen = $request->file('imagen');
            $nombreimagen = Str::slug($request->nombre) . "." . $imagen->guessExtension();
            $ruta = public_path("/imagenes/productos/");

            // Guarda la nueva imagen
            $imagen->move($ruta, $nombreimagen);

            $producto->imagen = $nombreimagen;
        }

        $producto->save(); // No olvides guardar los cambios

        return redirect()->route('producto.index');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estado = "Inactivo";
        $producto->save(); // Guarda el estado actualizado
        return redirect()->route('producto.index');
    }
}
