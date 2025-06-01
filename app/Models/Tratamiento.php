<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'tratamientos';
    protected $primaryKey = 'id';
    protected $fillable = ['quimico_id', 'dosis', 'nombre_tratamiento','tempmax','tempmin'];

}
