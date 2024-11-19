<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    
    protected $table = 'ingresos';
    protected $primarKey = 'id';

    public $timestamps = false;

    protected $fillable = ['id_proovedor', 'comprobante', 'num_comprobante', 'fecha_hora', 'impuesto', 'estatus'];
}
