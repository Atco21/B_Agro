<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    protected $fillable = ['nombre_completo', 'dni', 'telefono', 'email', 'direccion', 'iban', 'seguridad_social', 'fecha_nacimiento', 'usuario', 'password', 'rol', 'imagen', 'activo', 'dias_trabajo', 'explotacion_id'];
    protected $hidden = ['password'];
    protected $casts = [
        'dias_trabajo' => 'array'
    ];

    public function explotacion()
    {
        return $this->belongsTo(Explotacion::class);
    }
}
