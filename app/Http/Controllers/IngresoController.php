<?php

namespace App\Http\Controllers;

use App\Models\DetalleIngreso;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class IngresoController extends Controller
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
            $ingresos = DB::table('ingresos as i')
                ->join('personas as p', 'i.id_proveedor', '=', 'p.id')
                ->join('detalle_ingresos as di', 'di.id_ingreso', '=', 'i.id')
                ->select('i.id', 'i.fecha_hora','p.nombre', 'i.comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estatus',DB::raw('sum(di.cantidad * di.precio_compra) as total'))
                ->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
                ->groupby('i.id', 'i.fecha_hora', 'p.nombre', 'i.comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estatus')
                ->orderBy('i.id', 'desc')
                ->paginate(15);

            return view('compras.ingreso.index',['ingresos' => $ingresos, 'texto' => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personas = DB::table('personas')->where('tipo_persona', '=', 'Proveedor')->get();
        $ingreso = Ingreso::all();

        $productos = DB::table('productos as p')
            ->select(DB::raw('CONCAT(p.codigo, " ", p.nombre) AS Producto'), 'p.id', 'p.stock')
            ->where('p.estatus', '=', 'Activo')
            ->get();
        
        return view('compras.ingreso.create', compact('personas', 'productos', 'ingreso'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::breginTransaction();

            $ingreso = new Ingreso;
            $ingreso->id_proveedor = $request->get('id_proveedor');
            $ingreso->comprobante = $request->get('comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');
            $mytime = Carbon::now('America/Mexico_City');
            $ingreso->fecha_hora = $mytime->toDateTimeString();        
            $ingreso->impuesto = '16';
            $ingreso->estatus = 'A';
            $ingreso->save();
            
            $id_producto = $request->get('id_producto');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');
            
            $cont = 0;

            while($cont < count($id_producto)){
                $detalle = new DetalleIngreso;
                $detalle -> id_ingreso = $ingreso -> id_ingreso;
                $detalle -> id_producto = $id_producto[$cont];
                $detalle -> cantidad = $cantidad[$cont];
                $detalle -> precio_compra = $precio_compra[$cont];
                $detalle -> precio_venta = $precio_venta[$cont];
                $detalle -> save();

                $cont = $cont + 1;
            }

            DB::commit();
            
        }catch(\Exception $e){

            DB::rollBack();
        }

        return Redirect::to('compras/ingreso');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ingreso = DB::table('ingresos as i')
                ->join('personas as p', 'i.id_proveedor', '=', 'p.id')
                ->join('detalle_ingresos as di', 'di.id_ingreso', '=', 'i.id')
                ->select('i.id', 'i.fecha_hora','p.nombre', 'i.comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estatus',DB::raw('sum(di.cantidad * di.precio_compra) as total'))
                ->where('i.id', '=', $id)
                ->groupby('i.id', 'i.fecha_hora', 'p.nombre', 'i.comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estatus')
                ->orderBy('i.id', 'desc')
                ->first();
        
        $detalles = DB::table('detalle_ingresos as di')
                ->join('productos as p', 'di.id_producto', '=', 'p.id')
                ->select('p.nombre as producto', 'di.cantidad', 'di.precio_compra', 'di.precio_venta')
                ->where('di.id_ingreso', '=', $id)
                ->get();
        
        return view('compras.ingreso.show', compact('ingreso', 'detalles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->estatus = "C";
        $ingreso->update(); 
        return Redirect::to('compras/ingreso');
    }
}
