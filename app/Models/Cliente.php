<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'personas'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria personalizada

    public $timestamps = false; // Desactiva los timestamps si no usas created_at y updated_at

    protected $fillable = [
        'tipo_persona',
        'nombre', 
        'tipo_documento',
        'numero_documento',
        'direccion',
        'telefono',
        'email',
    ];
}
