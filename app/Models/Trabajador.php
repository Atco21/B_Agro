<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Trabajador extends Model
{

    protected $table = 'trabajadores';

    protected $fillable = [
        'nombre',
        'dni',
        'telefono',
        'email',
        'fecha_nacimiento',
        'usuario',
        'password',
        'rol',
        'imagen',
        'explotacion_id'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'explotacion_id' => 'integer',
    ];

    public function explotacion()
    {
        return $this->belongsTo(Explotacion::class);
    }

    public function oredenes(){
        return $this->hasMany(Orden::class);
    }
}
