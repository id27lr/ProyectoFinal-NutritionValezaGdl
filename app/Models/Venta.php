<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    
    protected $table = 'ventas';
    protected $primaryKey = 'id';

    protected $fillable = ['id_cliente','tipo_comprobante','num_comprobante', 'fecha_hora', 'impuesto', 'total_venta', "estatus"];
}
