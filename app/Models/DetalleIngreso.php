<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;
    
    protected $table = 'detalle_ingresos';
    protected $primarKey = 'id';

    public $timestamps = false;

    protected $fillable = ['id_ingreso', 'id_producto', 'cantidad', 'precio_compra', 'precio_venta'];
}
