<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'tratamientos';
    protected $primaryKey = 'id_tratamiento';
    protected $fillable = ['producto_quimico', 'dosis', 'nombre_tratamiento','tempmax','tempmin'];

}
