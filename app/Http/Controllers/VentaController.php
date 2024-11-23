<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VentaController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request){
            $query = trim($request->get('texto'));
            $ventas = DB::table('ventas as v')
                ->join('personas as p', 'v.id_cliente', '=', 'p.id')
                ->join('detalle_ventas as dv', 'dv.id_venta', '=', 'v.id')
                ->select('v.id', 'v.fecha_hora','p.nombre', 'v.tipo_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estatus', 'v.total_venta')
                ->where('v.num_comprobante', 'LIKE', '%'.$query.'%')
                ->groupby('v.id', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estatus')
                ->orderBy('v.id', 'desc')
                ->paginate(15);

            return view('ventas.venta.index',['ventas' => $ventas, 'texto' => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personas = DB::table('personas')->where('tipo_persona', '=', 'Cliente')->get();

        $productos = DB::table('productos as p')
            ->join('detalle_venta as di', 'dv.id_producto', '=', 'p.id')
            ->select(DB::raw('CONCAT(p.codigo, " ", p.nombre) AS Producto'), 'p.id', 'p.stock', DB::raw('avg(dv.precio_venta) as precio_promedio'))
            ->where('p.estatus', '=', 'Activo')
            ->where('p.stock', '>', '0')
            ->groupBy('Producto', 'p.id', 'p.stock')
            ->get();
        
        return view('ventas.venta.create', compact('personas', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::breginTransaction();

            $venta = new Venta;
            $venta->id_cliente = $request->get('id_cliente');
            $venta->tipo_comprobante = $request->get('tipo_comprobante');
            $venta->num_comprobante = $request->get('num_comprobante');
            $mytime = Carbon::now('America/Mexico_City');
            $venta->fecha_hora = $mytime->toDateTineString();        
            $venta->impuesto = '16';
            $venta->estatus = 'A';
            $venta->save();
            
            $id_producto = $request->get('id_producto');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $descuento = $request->get('descuento');
            
            $cont = 0;

            while($cont < count($id_producto)){
                $detalle = new DetalleVenta;
                $detalle -> id_venta = $venta -> id_venta;
                $detalle -> id_producto = $id_producto[$cont];
                $detalle -> cantidad = $cantidad[$cont];
                $detalle -> precio_venta = $precio_venta[$cont];
                $detalle -> descuento = $descuento[$cont];
                $detalle -> save();

                $cont = $cont + 1;
            }

            DB::commit();
            
        }catch(\Exception $e){

            DB::rollBack();
        }

        return Redirect::to('ventas/venta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = DB::table('ventas as v')
                ->join('personas as p', 'v.id_cliente', '=', 'p.id')
                ->join('detalle_ventas as dv', 'dv.id_venta', '=', 'v.id')
                ->select('v.id', 'v.fecha_hora','p.nombre', 'v.tipo_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estatus', 'v.total_venta')
                ->where('v.id', '=', $id)
                ->first();
        
        $detalles = DB::table('detalle_ventas as dv')
                ->join('productos as p', 'dv.id_producto', '=', 'p.id')
                ->select('p.nombre as producto', 'dv.cantidad', 'dv.precio_compra', 'dv.precio_venta')
                ->where('dv.id_venta', '=', $id)
                ->get();
        
        return view('ventas.venta.show', compact('venta', 'detalles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->estatus = "C";
        $venta->update(); 
        return Redirect::to('ventas/venta');
    }
}
