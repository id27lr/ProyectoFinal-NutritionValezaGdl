<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    
    protected $table = 'categorias';
    protected $primarKey = 'id';

    public $timestamps = false;

    protected $fillable = ['categoria', 'descripcion', 'estatus'];

}
