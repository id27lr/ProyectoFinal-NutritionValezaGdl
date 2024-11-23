<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    
    protected $table = 'detalle_ventas';
    protected $primarKey = 'id';

    public $timestamps = false;

    protected $fillable = ['id_venta', 'id_producto', 'cantidad', 'precio_venta', 'descuento'];
}
