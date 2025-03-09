<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    protected $table = 'maquina';
    protected $primaryKey = 'id';
    protected $fillable = ['explotacion_id', 'nombre', 'capacidad', 'imagen', 'matricula', 'estado'];


    public function explotacion()
    {
        return $this->belongsTo(Explotacion::class);
    }
}
