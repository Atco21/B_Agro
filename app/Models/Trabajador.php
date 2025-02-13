<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    protected $fillable = ['nombre_completo', 'id_maquina', 'telefono', 'email', 'fecha_nacimiento', 'usuario', 'password', 'rol', 'imagen', 'explotacion_id'];
    protected $hidden = ['password'];


    public function explotacion()
    {
        return $this->belongsTo(Explotacion::class);
    }
}
